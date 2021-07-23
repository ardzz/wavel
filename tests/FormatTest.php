<?php

use Ardzz\Wavel\Cores\Format;

test('format group id', function () {
    expect(Format::number('00000-1111@g.us', true))->toBe('00000-1111@g.us');
});

test('format user id', function () {
    expect(Format::number('000000'))->toBe('000000@c.us');
});

it('can format from document to be data url (data:%s;base64,%s)', function (){
    expect(Format::document(__DIR__ . '/../sample_file'))->toBe('data:text/plain;base64,dGVzdENhc2UK');
});

it('can format image to data url and validate that input is image', function(){
    expect(Format::image(__DIR__ . '/../sample_file'))->toBeFalse();
});

it('can format participant group', function(){
    expect(Format::participantsGroup([
        '123',
        '321'
    ]))->toBe(array_map(fn($value) => $value . '@c.us', [
        '123',
        '321'
    ]));
});
