<?php

namespace App\Livewire;

use App\Models\Booking;
use App\Models\Property;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BookingManager extends Component
{
    public Property $property;

    public string $startDate = '';
    public string $endDate   = '';
    public string $notes     = '';

    public ?float $totalPrice = null;
    public ?int   $nights     = null;

    public bool $bookingSuccess = false;
    public string $availabilityMessage = '';

    protected function rules(): array
    {
        return [
            'startDate' => ['required', 'date', 'after_or_equal:today'],
            'endDate'   => ['required', 'date', 'after:startDate'],
            'notes'     => ['nullable', 'string', 'max:500'],
        ];
    }

    protected $messages = [
        'startDate.required'       => 'La date d\'arrivée est obligatoire.',
        'startDate.after_or_equal' => 'La date d\'arrivée doit être aujourd\'hui ou ultérieure.',
        'endDate.required'         => 'La date de départ est obligatoire.',
        'endDate.after'            => 'La date de départ doit être après la date d\'arrivée.',
    ];

    public function updatedStartDate(): void
    {
        $this->calculateTotal();
        $this->checkAvailability();
    }

    public function updatedEndDate(): void
    {
        $this->calculateTotal();
        $this->checkAvailability();
    }

    private function calculateTotal(): void
    {
        if ($this->startDate && $this->endDate && $this->endDate > $this->startDate) {
            $this->nights     = (int) now()->parse($this->startDate)->diffInDays($this->endDate);
            $this->totalPrice = $this->nights * $this->property->price_per_night;
        } else {
            $this->nights     = null;
            $this->totalPrice = null;
        }
    }

    private function checkAvailability(): void
    {
        if (! $this->startDate || ! $this->endDate || $this->endDate <= $this->startDate) {
            $this->availabilityMessage = '';
            return;
        }

        $available = $this->property->isAvailableFor($this->startDate, $this->endDate);
        $this->availabilityMessage = $available ? 'available' : 'unavailable';
    }

    public function book(): void
    {
        if (! Auth::check()) {
            $this->dispatch('redirect', url: route('login'));
            return;
        }

        $this->validate();

        if (! $this->property->isAvailableFor($this->startDate, $this->endDate)) {
            $this->addError('startDate', 'Ce bien n\'est pas disponible pour ces dates.');
            return;
        }

        Booking::create([
            'user_id'     => Auth::id(),
            'property_id' => $this->property->id,
            'start_date'  => $this->startDate,
            'end_date'    => $this->endDate,
            'total_price' => $this->totalPrice,
            'status'      => 'pending',
            'notes'       => $this->notes ?: null,
        ]);

        $this->reset(['startDate', 'endDate', 'notes', 'totalPrice', 'nights', 'availabilityMessage']);
        $this->bookingSuccess = true;
        $this->dispatch('booking-created');
    }

    public function render()
    {
        return view('livewire.booking-manager');
    }
}