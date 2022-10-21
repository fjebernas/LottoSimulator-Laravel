$('#chkbx-random-digits').on('click', function(){
    if ($(this).is(':checked')) {
        triggerRandomCheckboxes();
    } else {
        uncheckAllCheckboxes();
    }
});

function uncheckAllCheckboxes() {
    $('.form-check-input-digits').prop('checked', false);
}

function triggerRandomCheckboxes() {
    var randomDigits = createUniqueDigits();

    for (let i = 0; i < randomDigits.length; i++) {
        $('#' + randomDigits[i]).prop('checked', true);
    }
}

function createUniqueDigits() {
    var uniqueDigits = new Array(6);
    for (let i = 0; i < uniqueDigits.length; i++) {
        var digit;
        do {
            var digit = randomDigitFromInterval(1, 42);
        } while ($.inArray( digit, uniqueDigits) > -1);
        uniqueDigits[i] = digit;
    }
    
    return uniqueDigits;
}

function randomDigitFromInterval(min, max) {
    return Math.floor(Math.random() * (max - min + 1) + min);
}