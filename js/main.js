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
                ajaxHelper.put(e.get("coords"),t = "Это красивая метка").then(()=>{
                    _this.addPlacemark(e.get("coords"),t); 
                }).catch(()=>{
                    throw new Error("Error put coords into table");
                });               
            });
        })(this);
    }

    AjaxHelper = function () {
        var _url = "/coords", _send;
        _send = function (method, url) {
            if (!method)
                return null;
            return new Promise(function (resolve, reject) {
                var xhr = new XMLHttpRequest();
                xhr.open(method,_url+(url || ""), true);

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

                xhr.send();
            });
        }
        this.get = function(){
            return _send("GET");
        }
        this.put = function(coords,text){
            return _send("PUT","?lat="+coords[0]+"&lon="+coords[1]+"&text="+text);
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
    }).then((responce)=>{
        if (!responce)
            return;
        JSON.parse(responce).map((cur)=>{
           mapHelper.addPlacemark([
               cur["lat"],
               cur["lon"]
           ],cur["text"]);
        });
    });
})