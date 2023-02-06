
$.extend(measures.prototype, {
    constructor: measures,

    setMap: function(map) {
        if (this.map) {
            this._unbindMap(this.map);
        }

        this.map = map;

        if (map) {
            this._bindMap(map);
        }
    },

    
    _startDistance: function() {
        var map = this.map;

        this._distanceListeners = this._onClickDistance.bind(this);
    },
    _onClickDistance: function(e) {
        var map = this.map,
            coord = e.coord;

        if (!this._polyline) {
            
            // 실제 거리재기에 사용되는 폴리라인을 생성합니다.
            this._polyline = new naver.maps.Polyline({
                strokeColor: '#f00',
                strokeWeight: 5,
                strokeOpacity: 0.8,
                path: [coord],
                map: map
            });

            // 폴리라인의 거리를 미터 단위로 반환합니다.
            this._lastDistance = this._polyline.getDistance();
        } else {
            this._guideline.setPath([e.coord]);
            this._polyline.getPath().push(coord);

            // 폴리라인의 거리를 미터 단위로 반환합니다.
            var distance = this._polyline.getDistance();

            this._addMileStone(coord, this._fromMetersToText(distance - this._lastDistance));

            this._lastDistance = distance;
        }
    },
 

    _finishDistance: function() {

        if (this._polyline) {
            var path = this._polyline.getPath(),
                lastCoord = path.getAt(path.getLength() - 1),
                distance = this._polyline.getDistance();
                // 폴리라인의 거리를 미터 단위로 반환합니다.

            delete this._polyline;

            if (lastCoord) {
                this._addMileStone(lastCoord, this._fromMetersToText(distance), {
                    'font-size': '14px',
                    'font-weight': 'bold',
                    'color': '#f00'
                });
            }
        }
        map.setCursor('auto');

        this._mode = null;
    },

    finishMode: function(mode) {
        if (!mode) return;

        
        this._finishDistance();
      
    },

    _fromMetersToText: function(meters) {
        meters = meters || 0;

        var km = 1000,
            text = meters;

        if (meters >= km) {
            text = parseFloat((meters / km).toFixed(1)) +'km';
        } else {
            text = parseFloat(meters.toFixed(1)) +'m';
        }

        return text;
    },

   
    _addMileStone: function(coord, text, css) {
        if (!this._ms) this._ms = [];

        var ms = new naver.maps.Marker({
            position: coord,
            icon: {
                content: '<div style="display:inline-block;padding:5px;text-align:center;background-color:#fff;border:1px solid #000;"><span>'+ text +'</span></div>',
                anchor: new naver.maps.Point(-5, -5)
            },
            map: this.map
        });

        var msElement = $(ms.getElement());

        if (css) {
            msElement.css(css);
        } else {
            msElement.css('font-size', '11px');
        }

        this._ms.push(ms);
    },

    _bindMap: function(map) {

    },

    _unbindMap: function() {
        this.unbindAll();
    },

});

var measures = new measures({
    distance: $('#distance'),
});

measures.setMap(map);