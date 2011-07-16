// jQuery Location Picker plugin - https://github.com/wvega/location-picker
//
// A jQuery plugin to enhance standard form input fields helping users to select
// a location using Google Maps.
//
// Copyright (c) 2010 Willington Vega <wvega@wvega.com>
//
// Permission is hereby granted, free of charge, to any person obtaining a copy
// of this software and associated documentation files (the "Software"), to deal
// in the Software without restriction, including without limitation the rights
// to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
// copies of the Software, and to permit persons to whom the Software is
// furnished to do so, subject to the following conditions:
//
// The above copyright notice and this permission notice shall be included in
// all copies or substantial portions of the Software.
//
// THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
// IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
// FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
// AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
// LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
// OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
// THE SOFTWARE.

// TODO: track zoom changes
// TODO: read initial field value
// TODO: allow clear the content of the field

if (typeof jQuery !== 'undefined') {
    (function($, undefined) {
        
        $.LocationPicker = function(node, options) {
            var widget = this, metadata;
            
            options = $.extend({}, $.LocationPicker.options, options);
            widget.element = $(node);
            
            if (widget.element.data('LocationPicker')) { return; }
            
            metadata = $.metadata ? widget.element.metadata() : {};
            
            widget.options = $.extend({}, options, metadata);
            widget.render();
        };
        
        $.LocationPicker.prototype = {
            render: function() {
                var widget = this, canvas, options, map, marker;
                
                canvas = widget.canvas = $('<div class="location-picker">').insertAfter(widget.element.hide());
                canvas.append($('<div class="map">').css({
                    width: widget.options.width,
                    height: widget.options.height
                }));
                canvas.append('<div class="label">' + widget.label() + '</div>');
                
                console.log(widget.element);
                
                options = $.extend({}, widget.options.map);
                map = widget.map = new google.maps.Map(canvas.find('.map').get(0), options);
                console.log(options);
                
                options = $.extend({map: map}, widget.options.marker);
                marker = widget.marker = new google.maps.Marker(options);
                
                google.maps.event.addListener(map, 'click', function(event) {
                    widget.setPosition(event.latLng);
                    widget.update();
                });
                
                google.maps.event.addListener(map, 'zoom_changed', function(event) {
                    widget.update();
                });
            },
            
            label: function(lat, lng) {
                return this.options.label(lat, lng);
            },
            
            update: function() {
                var widget = this;
                position = widget.marker.getPosition();
                zoom = widget.map.getZoom();
                
                if (position) {
                    label = widget.label(position.lat(), position.lng());
                    widget.element.val(position.lat() + ':' + position.lng() + ':' + zoom);
                } else {
                    label = widget.label();
                    widget.element.val('::' + zoom);
                }
                
                widget.canvas.find('.label').empty().append(label);
            },
            
            setPosition: function(position) {
                var widget = this;
                widget.map.panTo(position);
                widget.marker.setPosition(position);
            },
            
            setZoom: function(zoom) {
                var widget = this;
                widget.map.setZoom(zoom);
            }
        };
        
        $.LocationPicker.options = {
            width: '400px',
            height: '300px',
            map: {
                center: new google.maps.LatLng(6.246619882423697, -75.57512270825191),
                zoom: 12,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            },
            marker: {},
            label: function(lat, lng) {
                if (typeof lat == 'undefined' || typeof lng == 'undefined') {
                    lng = lat = '--';
                } else {
                    var p = 1000000000;
                    lat = Math.round(lat * p) / p;
                    lng = Math.round(lng * p) / p;
                }
                return '<b>Lat:</b> ' + lat + ', <b>Long:</b> ' + lng;
            }
        }
        
        $.fn.location = function(options) {
            var instance, element;
            return this.each(function() {
                element = $(this);
                console.log(element.data('LocationPicker'));
                if (typeof element.data('LocationPicker') === 'undefined') {
                    instance = new $.LocationPicker(element.get(0), options);
                    element.data('LocationPicker', instance);
                }
            });
        }
        
    })(jQuery);
}
