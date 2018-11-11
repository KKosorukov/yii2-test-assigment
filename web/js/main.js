var RouletteComponent = (function() {
    return {
        config: null,

        bindEvents: function () {
            $('#spin-btn ').on('click', $.bind(this.spinRoulette, this));
        },

        spinRoulette: function() {
            $.ajax({
                url: '/prize/get',
                type: 'GET',
                dataType: 'JSON',
                cache: false,
                success: function (data) {
                    console.log(data);
                }
            });
        },

        init: function (config) {
            if (config) {
                this.config = config;
            }

            this.bindEvents();

            return this;
        }
    }
});

$(function() {
   new RouletteComponent.init({

   });
});
