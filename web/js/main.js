var RouletteComponent = (function() {
    return {
        config: null,

        bindEvents: function () {
            $('#spin-btn').on('click', $.bind(this.spinRoulette, this));

            $('#send-btn').on('click', $.bind(this.sendPrize, this));

            $('#cancel-btn').on('click', $.bind(this.cancelPrize, this));

            $('#convert-btn').on('click', $.bind(this.convertToLoyality, this));
        },

        /**
         * Cancel prize
         */
        cancelPrize: function() {
            $.ajax({
                url: '/prize/cancel',
                type: 'POST',
                dataType: 'JSON',
                cache: false,
                success: function (data) {
                    console.log(data);
                }
            });
        },

        /**
         * Spin roulette and get prize
         */
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

        /**
         * Display prize info
         */
        displayPrizeInfo: function() {

        },

        /**
         * Send prize
         */
        sendPrize: function() {
            $.ajax({
                url: '/prize/send',
                type: 'POST',
                dataType: 'JSON',
                data: {

                },
                cache: false,
                success: function (data) {
                    console.log(data);
                }
            });
        },

        /**
         * Convert bonus to loyality
         */
        convertToLoyality: function() {
            $.ajax({
                url: '/prize/getmoneyfrombonus',
                type: 'GET',
                dataType: 'JSON',
                data: {

                },
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
