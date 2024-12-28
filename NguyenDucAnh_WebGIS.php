<script>
  NguyenDucAnh_WebGIS = L.TileLayer.WMS.extend({

    onAdd: function(map) {
      L.TileLayer.WMS.prototype.onAdd.call(this, map);
      map.on('click', this.getFeatureInfo, this);
    },
    onRemove: function(map) {
      L.TileLayer.WMS.prototype.onRemove.call(this, map);
      map.off('click', this.getFeatureInfo, this);
    },

    getFeatureInfo: function(evt) {
      var url = this.getFeatureInfoUrl(evt.latlng);
      var showResults = L.Util.bind(this.showGetFeatureInfo, this);

      $.ajax({
        url: 'proxy.php?url=' + encodeURIComponent(url),
        success: function(data, status, xhr) {
          var err = typeof data === 'string' ? null : data;
          showResults(err, evt.latlng, data);
        },
        error: function(xhr, status, error) {
          showResults(error);
        }
      });
    },


    getFeatureInfoUrl: function(latlng) {
      var point = this._map.latLngToContainerPoint(latlng, this._map.getZoom()),
        size = this._map.getSize(),

        params = {
          request: 'GetFeatureInfo',
          service: 'WMS',
          srs: 'EPSG:4326',
          styles: this.wmsParams.styles,
          transparent: this.wmsParams.transparent,
          version: this.wmsParams.version,
          format: this.wmsParams.format,
          bbox: this._map.getBounds().toBBoxString(),
          height: size.y,
          width: size.x,
          layers: ['tanchanhhiep', 'giaothong'],
          query_layers: this.wmsParams.layers,
          info_format: 'application/json'
        };

      params[params.version === '1.3.0' ? 'i' : 'x'] = Math.round(point.x);
      params[params.version === '1.3.0' ? 'j' : 'y'] = Math.round(point.y);

      return this._url + L.Util.getParamString(params, this._url, true);
    },

    showGetFeatureInfo: function(err, latlng, content) {

      if (err) {
        console.log(err);
        return;
      }
      // code hiện thông tin thửa đất khi bấm vào

      var vi_do = latlng.lat;
      var kinh_do = latlng.lng;
      var data = JSON.parse(content);
  

      // if (layers == 'tanchanhhiep') {
        var to_so = data.features[0].properties.to_so;
        var thua_so = data.features[0].properties.thua_so;
        var loai_dat = data.features[0].properties.loai_dat;
        var dien_tich = data.features[0].properties.dien_tich;
        var thua_id = data.features[0].properties.thua_id;
      // } 

       

      L.popup({}).setLatLng([vi_do, kinh_do]).setContent("Tờ số "+ to_so +", Thửa số "+ thua_so+ ", Loại đất "+ loai_dat+ ", Diện tích "+ dien_tich +" m<sup>2</sup><br><a href ='http://localhost/22_12_2024/update.php?gid="+ thua_id +"'><i class='fa-solid fa-pen-to-square'></i></a>").openOn(map);

      // else if (layers == 'giaothong'){
      //   code lấy thông tin giao thông
      // }      => NẾU CÓ NHIỀU LỚP THÌ DÙNG IF

    }
  });

  L.tileLayer.betterWms = function(url, options) {
    return new NguyenDucAnh_WebGIS(url, options);
  };
</script>