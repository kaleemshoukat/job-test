<?php

namespace App\Http\Livewire;

use App\Employee;
use App\Events\EmployeeCreated;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Employees extends Component
{
    public $name, $age, $designation, $employee_id;
    public $updateMode = false;
    public $showNewOrderNotification = false;

    protected $listeners = ['echo:EmployeeChannel,EmployeeCreated' => 'notifyNewOrder'];

    public function render(){
        $employees=Employee::all();
        return view('livewire.employees', compact('employees'));
    }

    private function resetInputFields(){
        $this->name = '';
        $this->age = '';
        $this->designation = '';
    }

    public function store(){
        $this->validate([
            'name' => 'required',
            'age' => 'required',
            'designation' => 'required',
        ]);

        $employee=new Employee();
        $employee->name=$this->name;
        $employee->age=$this->age;
        $employee->designation=$this->designation;
        $employee->save();

        event(new EmployeeCreated($employee));

        session()->flash('message', 'Employee Created Successfully.');
        $this->resetInputFields();
        $this->updateMode=false;
    }

    public function getListeners()
    {
        $user_id=Auth::user()->id;
        return [
            "echo-private:EmployeeChannel-.{$user_id},EmployeeCreated" => 'notifyNewOrder',
            // Or:
            //"echo-presence:EmployeeChannel-.{$this->user_id},EmployeeCreated" => 'notifyNewOrder',
        ];
    }

    public function notifyNewOrder()
    {
        $this->showNewOrderNotification = true;
    }

    public function edit($id){
        $this->updateMode = true;
        $user = Employee::where('id',$id)->first();
        $this->employee_id = $id;
        $this->name = $user->name;
        $this->age = $user->age;
        $this->designation = $user->designation;
    }

    public function update(){
        $this->validate([
            'name' => 'required',
            'age' => 'required',
            'designation' => 'required',
        ]);

        $employee=Employee::where('id', $this->employee_id)->first();
        $employee->name=$this->name;
        $employee->age=$this->age;
        $employee->designation=$this->designation;
        $employee->save();

        session()->flash('message', 'Employee Updated Successfully.');
        $this->resetInputFields();
        $this->updateMode=false;
    }

    public function delete($id){
        if(isset($id)){
            Employee::where('id',$id)->delete();
            session()->flash('message', 'Employee Deleted Successfully.');
        }
    }

    public function cancel(){
        $this->resetInputFields();
        $this->updateMode=false;
    }

}
