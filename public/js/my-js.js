function AddFormCart() {
    $('#card').html(
            '<label for="card-element">' +
            'New credit or debit card:' +
            '</label>' +
            '<div id="card-element"></div>' +
            '<div id="card-errors" role="alert"></div>'
        );
}
