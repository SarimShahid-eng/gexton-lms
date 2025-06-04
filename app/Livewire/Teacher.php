<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\CustomSession;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;


class Teacher extends Component
{
    use WithPagination;
    public $firstname, $lastname, $email, $phone, $session_year_id, $password, $is_active, $id, $new_password;

    public function render()
    {
        $session_active = CustomSession::where('is_selected',1)->first();
        $this->session_year_id = $session_active->id;
        $teachers = User::with('session')->where('session_year_id',$session_active->id)
        ->where('user_type','teacher')
        ->paginate(10);
        return view('livewire.teacher', compact('teachers','session_active'));
    }
    public function save()
    {
        $rules = [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|unique:users,phone',
            'session_year_id' => 'required|integer',
            'password' => $this->id ? 'nullable': 'required',
            'is_active' => 'required',
        ];
        $messages = [
            'firstname.required' => 'Please enter the first name.',
            'lastname.required' => 'Please enter the second name',
            'email.required' => 'Please enter the email',
            'phone.required' => 'Please enter the phone number',
            'password.required' => 'Please enter the phone number',
            'is_active.required' => 'Please select the status',
        ];
        // If updating, ignore unique check for current record
        if ($this->id) {
            $rules['email'] = 'required|email|unique:users,email,' . $this->id;
            $rules['phone'] = 'required|unique:users,phone,' . $this->id;
        }


        $validatedData = $this->validate($rules, $messages);
        $validatedData['user_type']='teacher';
        if ($this->password) {
            $validatedData['password'] = Hash::make($this->password);
        }
        if ($this->id && !$this->password) {
            unset($validatedData['password']);
        }
        if ($this->id) {
            User::where('id', $this->id)->update($validatedData);
            session()->flash('message', 'Teacher Updated Successfully');
        } else {
            User::create($validatedData);
            session()->flash('message', 'Teacher Created Successfully');
        }

        $message = $this->id ? 'updated' : 'saved';
        $this->reset();
        $this->dispatch(
            'course-saved',
            title: 'Success!',
            text: "Teacher has been $message successfully.",
            icon: 'success',
        );
        sleep(1);

        return redirect()->route('show_teachers');
    }
    function edit($id)
    {
        $teacher = User::find($id);
        // dd($teacher);
        $this->firstname = $teacher->firstname;
        $this->lastname = $teacher->lastname;
        $this->email = $teacher->email;
        $this->phone = $teacher->phone;
        $this->new_password = $teacher->password;
        $this->session_year_id = $teacher->session_year_id;
        $this->is_active = $teacher->is_active ? 1 : 0;
        // dd($teacher->is_active);
        $this->id = $teacher->id;
    }
    public function confirmDelete($courseId)
    {
        $this->id = $courseId;
        $this->dispatch('swal-confirm');
    }
    public function deleteCourse()
    {
         User::destroy($this->id); // Find the course by ID

            $this->dispatch('course-deleted', title: 'Deleted!', text: 'Teacher has been deleted successfully.', icon: 'success');
    }

}
