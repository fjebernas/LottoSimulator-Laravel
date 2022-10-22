var combinationCount = parseInt($('.concealed-data').attr('data-combination-count'));
var rangeMin = parseInt($('.concealed-data').attr('data-range-min'));
var rangeMax = parseInt($('.concealed-data').attr('data-range-max'));

// create button disabled by default
$('#btn-create').addClass('disabled').prop('disabled', true);

// for preventing the user to check checkboxes more than six
$('input[type="checkbox"]').change(function(event) {
    $('input[type="checkbox"].form-check-input-digits').prop('disabled', false);
    if ($('input[type="checkbox"].form-check-input-digits:checked').length >= combinationCount) {
        event.preventDefault();
        $('input[type="checkbox"].form-check-input-digits').not(':checked').prop('disabled', true);
        // enable create button
        $('#btn-create').removeClass('disabled').prop('disabled', false);
    }
    else if ($('input[type="checkbox"].form-check-input-digits:checked').length < combinationCount) {
        $('input[type="checkbox"].form-check-input-digits').not(':checked').prop('disabled', false);
        // disable create button
        $('#btn-create').addClass('disabled').prop('disabled', true);
    }
});

// tick to select random digits
$('#chkbx-random-digits').on('click', function(){
    uncheckAllCheckboxes();
    if ($(this).is(':checked')) {
        triggerRandomCheckboxes();
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
    var uniqueDigits = new Array(combinationCount);
    for (let i = 0; i < uniqueDigits.length; i++) {
        var digit;
        do {
            var digit = randomDigitFromInterval(rangeMin, rangeMax);
        } while ($.inArray( digit, uniqueDigits) > -1);
        uniqueDigits[i] = digit;
    }
    
    return uniqueDigits;
}

function randomDigitFromInterval(min, max) {
    return Math.floor(Math.random() * (max - min + 1) + min);
}