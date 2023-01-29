{
    new Vue({
        el: '#vueConect',
        data: {
            counter: 0,
            apiResponse: [],
            conectadi: 'VUE JS'

        },
        created: function() {
            this.getUrl('Api_category');
        },
        methods: {
            getUrl: function(urlGet) {
                this.$http.get(urlGet).then(function(response){this.apiResponse = response.body });
            }

        },
        computed:{}
    })
}
