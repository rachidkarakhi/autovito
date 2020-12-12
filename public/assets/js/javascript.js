/*!
 * Bootstrap v4.2.1 (https://getbootstrap.com/)
 * Copyright 2011-2018 The Bootstrap Authors (https://github.com/twbs/bootstrap/graphs/contributors)
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 */
(function ($) {
    $(document).ready(function () {

        $('.dynamic').change(function () {
            if ($(this).val() != '') {
                var select = $(this).attr('id');
                var value = $(this).val();
                var dependent = $(this).data('dependent');
                var _token = $('input[name="_token"]').val();
                // alert(_token + ' '+ value + ' '+select+ ' ' + dependent ); //9 sousCategories piece 7 catigorie_idCat sousCategories

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('annancecontroller.fetch') }}",
                    method: "POST",
                    data: {
                        select: select,
                        _token: _token,
                        'value': value,
                        'dependent': dependent
                    },

                    success: function (result) {
                        // alert(result + 'oui');
                        $('#' + dependent).html(result);
                    },
                    error: function () {
                        alert("error!!!!");
                    }


                })



            }
        });

        $('#marque').change(function () {
            $('#module').val('');
            $('#motorisation').val('');
        });

        $('#marque').change(function () {
            $('#module').val('');
        });


    });
})(jQuery);
