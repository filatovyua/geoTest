"use strict";
document.addEventListener("DOMContentLoaded", () => {
        
    var myMap, promise, MapHelper, AjaxHelper, mapHelper, ajaxHelper;
    MapHelper = function () {

        this.addPlacemark = function (coords, hintContent) {
            myMap.geoObjects.add((new ymaps.Placemark(coords, {
                hintContent: hintContent,
                balloonContent: 'Это красивая метка',
                draggable: false
            }, {
                preset: 'twirl#redIcon'
            })));
        }
        
        return (function(_this){
            myMap.events.add("click", function(e) {
                var t;
                ajaxHelper.put(e.get("coords"),t = "Это красивая метка").then((response)=>{
                    var res = JSON.parse(response);
                    if (res.success != 1){
                        alert("Извините, точка не добавлена");
                        return;
                    }
                    _this.addPlacemark(e.get("coords"),t); 
                }).catch(()=>{
                    throw new Error("Error put coords into table");
                });               
            });
        })(this);
    }

    AjaxHelper = function () {
        var _url = "/coords", _send;
        _send = function (method, data = []) {
            if (!method)
                return null;
            return new Promise(function (resolve, reject) {
                var xhr = new XMLHttpRequest();
                var json = JSON.stringify(data);
                xhr.open(method,_url, true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.setRequestHeader('X-CSRF-TOKEN',document.getElementsByName("csrf-token")[0].getAttribute("content"));
                xhr.onload = function () {
                    if (this.status == 200) {
                        resolve(this.response);
                    } else {
                        var error = new Error(this.statusText);
                        error.code = this.status;
                        reject(error);
                    }
                };
                xhr.onerror = function () {
                    reject(new Error("Network Error"));
                };
                xhr.send(json);
            });
        }
        this.get = function(){
            return _send("POST");
        }
        this.put = function(coords,text){
            return _send("PUT",[{
                lat: coords[0],
                lon: coords[1],
                text: text
            }]);
        }
    }

    promise = new Promise((resolve, reject) => {
        if (typeof ymaps === "undefined")
            return reject();
        ymaps.ready(() => {
            resolve();
        });
    }).then(() => {
        myMap = new ymaps.Map('map', {
            center: [55.751574, 37.573856],
            zoom: 9
        });
        mapHelper = new MapHelper();
        ajaxHelper = new AjaxHelper(); 
        return ajaxHelper.get();
    }).then((response)=>{
        if (!response)
            return;
        JSON.parse(response).forEach((cur)=>{
           mapHelper.addPlacemark([
               cur["lat"],
               cur["lon"]
           ],cur["text"]);
        });
    });
})