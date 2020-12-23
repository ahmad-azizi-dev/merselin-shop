<?php

namespace App\Http\Livewire\Admin\LoginByPhoneToken;

use App\Models\LoginByPhoneToken;
use Livewire\Component;
use Livewire\WithPagination;

class LoginByPhoneTokenIndex extends Component
{
    use WithPagination;

    public $perPage = 5;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.admin.login-by-phone-token.login-by-phone-token-index', [
            'tokens' => LoginByPhoneToken::orderBy('id', 'desc')->paginate($this->perPage),
        ]);
    }

    public function destroy($id)
    {
        if ($id) {
            $record = LoginByPhoneToken::where('id', $id);
            $record->delete();
        }
    }

    public function updatedperPage()
    {
        $this->resetPage();
    }
}
