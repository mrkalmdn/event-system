<?php

use App\Models\Event;
use App\Models\EventDetail;

it('shows the event page', function (Event $event) {
    $this->get('/')
        ->assertOk();

    expect($event->details->count())->toBe(3);
})
->with([
    fn () => Event::factory()
        ->has(EventDetail::factory()->count(3), 'details')
        ->create()
]);