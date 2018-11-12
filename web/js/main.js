var RouletteComponent = (function() {
    return {
        config: null,
        currentPrize: null, // Current choosed prize

        bindEvents: function () {
            $(document).on('click', '#spin-btn', $.proxy(this.spinRoulette, this));

            $(document).on('click', '#send-btn', $.proxy(this.sendPrize, this));

            $(document).on('click', '#cancel-btn', $.proxy(this.cancelPrize, this));

            $(document).on('click', '#convert-btn', $.proxy(this.convertToLoyality, this));
        },

        /**
         * Cancel prize
         */
        cancelPrize: function() {
            $.ajax({
                url: '/prize/cancel',
                type: 'POST',
                dataType: 'JSON',
                data: this.currentPrize.data,
                cache: false,
                success: function (data) {
                    if(data.success) {
                        $('#prizeDescription').html('Hehe, you cancel you prize! Now you are happy? :)')
                    } else {
                        // @TODO if any error is here....
                    }
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
                success: $.proxy(function (data) {
                    if(data.success) {
                        this.currentPrize = data.data;
                        this.displayPrizeInfo();
                    } else {
                        // @TODO if any error is here....
                    }
                }, this)
            });
        },

        /**
         * Display prize info
         */
        displayPrizeInfo: function() {
            if(this.currentPrize) {
                $('#prizeCont, #prizeDescription').html('');

                if(this.currentPrize.type == 'prize') {
                    $('<img>').prop({
                        'width' : 250,
                        'height' : 250,
                        'src' : this.currentPrize.data.img
                    }).appendTo('#prizeCont');

                    $('<span>')
                        .html('You won a ' + this.currentPrize.data.description + '! You can cancel, if you want, of course :)')
                        .appendTo('#prizeDescription');

                    $('#prizeDescription').append(
                        $('<button>')
                            .prop({
                                'id' : 'cancel-btn',
                                'name' : 'cancel-btn',
                                'class' : 'btn btn-primary'
                            })
                            .html('Cancel this prize')
                    );

                    $('#prizeDescription').append(
                        $('<button>')
                            .prop({
                                'id' : 'send-btn',
                                'name' : 'send-btn',
                                'class' : 'btn btn-primary'
                            })
                            .html('Send prize by postman')
                    );
                }
                if(this.currentPrize.type == 'bonus') {
                    $('<img>').prop({
                        'width' : 250,
                        'height' : 250,
                        'src' : 'https://vov-kosmetika.ru/wa-data/public/site/img/bonus-orange.png'
                    }).appendTo('#prizeCont');

                    $('<span>')
                        .html('You won a loyality bonus! Wow, ' + this.currentPrize.data + ' points!')
                        .appendTo('#prizeDescription');
                }
                if(this.currentPrize.type == 'money') {
                    $('<img>').prop({
                        'width' : 250,
                        'height' : 250,
                        'src' : 'https://cdn.iofferphoto.com/img/item/623/829/391/l_20-usd-100pcs-lot-training-banknotes-paper-money-7616.jpg'
                    }).appendTo('#prizeCont');

                    $('<span>')
                        .html('You won money bonus (' + this.currentPrize.data + '$)! Wanna you convert it to loyality points or send to your bank account?')
                        .appendTo('#prizeDescription');

                    $('#prizeDescription').append(
                        $('<button>')
                            .prop({
                                'id' : 'send-btn',
                                'name' : 'send-btn',
                                'class' : 'btn btn-primary'
                            })
                            .html('Send money to bank account')
                    );

                    $('#prizeDescription').append(
                        $('<button>')
                            .prop({
                                'id' : 'convert-btn',
                                'name' : 'convert-btn',
                                'class' : 'btn btn-primary'
                            })
                            .html('Convert money to bonus')
                    );
                }
            }
        },

        /**
         * Send prize
         */
        sendPrize: function() {
            $.ajax({
                url: '/prize/send',
                type: 'POST',
                dataType: 'JSON',
                data: this.currentPrize,
                cache: false,
                success: function (data) {
                    if(data.success) {
                        $('#prizeDescription').html('Your prize has been sent!');
                    }
                }
            });
        },

        /**
         * Convert bonus to loyality
         */
        convertToLoyality: function() {
            $.ajax({
                url: '/prize/getbonusfrommoney',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    money : this.currentPrize.data
                },
                cache: false,
                success: $.proxy(function (data) {
                    if(data.success) {
                        $('#prizeDescription').html('You converted ' + this.currentPrize.data + '$ to ' + data.bonus + ' loyality bonus!');
                    }
                }, this)
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
   var roulette = new RouletteComponent().init({

   });
});
