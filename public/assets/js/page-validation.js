$(document).ready(function () {
    $.validator.addMethod(
        "filesize",
        function (value, element, param) {
            return this.optional(element) || element.files[0].size <= param;
        },
        "File size must be less than {0}"
    );

    $.validator.addMethod(
        "letterswithspace",
        function (value, element) {
            return (
                this.optional(element) ||
                /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/i.test(value)
            );
        },
        "Enter valid data"
    );

    if ($("#registration").length > 0) {
        $("#registration").validate({
            rules: {
                name: {
                    required: true,
                    letterswithspace: true,
                    minlength: 3
                },
                email: {
                    required: true,
                    email: true,
                },
                phone: {
                    required: true,
                    maxlength: 10,
                    maxlength: 10,
                },
                department_id: {
                    required: true
                },

            },
            messages: {
                department_id: {
                    required: "Please select department",
                },
            },
        });

        $('#phone').keyup(function () {
            var value = $('#phone').val();

        });

        $('#email').keyup(function () {


        });

    }

});




