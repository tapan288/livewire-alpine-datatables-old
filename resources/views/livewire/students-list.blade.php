<div x-cloak x-init="$watch('selectPage', value => selectPageUpdated(value))" x-data="{
    studentsInPage: @entangle('studentsInPage'),
    allStudents: @entangle('allStudents'),
    selectPage: false,
    selectAll: false,
    selectedClass: @entangle('selectedClass'),
    sortField: @entangle('sortField'),
    sortDirection: @entangle('sortDirection'),
    checked: [],
    deleteSingleRecord(id) {
        this.checked = this.checked.filter(item => item !== id);
        $wire.emit('deleteSingleRecord', id);
    },
    deleteMultipleRecords() {
        $wire.emit('deleteMultipleRecords', this.checked);
        this.checked = [];
    },
    selectPageUpdated(value) {
        if (value) {
            this.checked = this.studentsInPage;
        } else {
            this.selectAll = false;
            this.checked = [];
        }
    },
    selectAllItems() {
        this.selectAll = true;
        this.checked = this.allStudents;
    },
    exportStudents() {
        $wire.emit('exportStudents', this.checked);
    }
}">
    <div class="d-flex justify-content-between align-content-center my-2">
        <div class="d-flex">
            <div>
                <div class="d-flex align-items-center ml-4">
                    <label for="paginate" class="text-nowrap me-2">Per Page</label>
                    <select name="paginate" id="paginate" class="form-control form-control-sm" wire:model="paginate">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                    </select>
                </div>
            </div>
            <div>
                <div class="d-flex align-items-center ms-4">
                    <label for="paginate" class="text-nowrap me-2">FilterBy Class</label>
                    <select class="form-control form-control-sm" wire:model="selectedClass">
                        <option value="">All Class</option>
                        @foreach ($classes as $class)
                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div x-show="selectedClass" x-transition>
                <div class="d-flex align-items-center ms-4">
                    <label for="paginate" class="text-nowrap me-2 mb-0">Section</label>
                    <select class="form-control form-control-sm" wire:model="selectedSection">
                        <option value="">Select a Section</option>
                        @foreach ($sections as $section)
                            <option value="{{ $section->id }}">{{ $section->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="dropdown ms-4" x-show="checked.length > 0" x-transition>
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    With Checked (<span x-text="checked.length"></span>)
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a href="#" class="dropdown-item" type="button"
                            onclick="confirm('Are you sure you want to delete these records?') || event.stopImmediatePropagation()"
                            @click="deleteMultipleRecords">
                            Delete
                        </a>
                    </li>
                    <li><a href="#" @click="exportStudents" class="dropdown-item" type="button">
                            Export
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-md-4">
            <input wire:model.debounce.500ms="search" type="search" class="form-control"
                placeholder="Search by name,email,phone,or address...">
        </div>
    </div>

    <div class="col-md-12 my-3">
        @include('includes.alerts')
    </div>

    <br>

    <div class="col-md-10 mb-3" x-transition>
        <div x-show="selectAll && selectPage">
            You are currently selecting <strong x-text="checked.length"></strong> items.
        </div>
        <div x-show="selectPage && !selectAll">
            You have selected <strong x-text="checked.length"></strong> items, Do you want to Select All
            <strong x-text="allStudents.length"></strong> items?
            <a href="#" @click="selectAllItems" class="ml-2">Select All</a>
        </div>
    </div>

    <div class="card-body table-responsive p-0">
        <table class="table table-hover">
            <tbody>
                <tr>
                    <th><input type="checkbox" x-model="selectPage"></th>
                    <th>
                        <a href="#" wire:click="changeSort('name')">
                            Student's Name
                            <span x-show="sortDirection == 'desc' && sortField == 'name'">&uarr;</span>
                            <span x-show="sortDirection == 'asc' && sortField == 'name'">&darr;</span>
                        </a>
                    </th>
                    <th>
                        <a href="#" wire:click="changeSort('email')">
                            Email
                            <span x-show="sortDirection == 'desc' && sortField == 'email'">&uarr;</span>
                            <span x-show="sortDirection == 'asc' && sortField == 'email'">&darr;</span>
                        </a>
                    </th>
                    <th>
                        <a href="#" wire:click="changeSort('address')">
                            Address
                            <span x-show="sortDirection == 'desc' && sortField == 'address'">&uarr;</span>
                            <span x-show="sortDirection == 'asc' && sortField == 'address'">&darr;</span>
                        </a>
                    </th>
                    <th>
                        <a href="#" wire:click="changeSort('phone_number')">
                            Phone Number
                            <span x-show="sortDirection == 'desc' && sortField == 'phone_number'">&uarr;</span>
                            <span x-show="sortDirection == 'asc' && sortField == 'phone_number'">&darr;</span>
                        </a>
                    </th>
                    <th>Class</th>
                    <th>Section</th>
                    <th>Action</th>
                </tr>
                @foreach ($students as $student)
                    <tr>
                        <td>
                            <input type="checkbox" value="{{ $student->id }}" x-model="checked" />
                        </td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->address }}</td>
                        <td>{{ $student->phone_number }}</td>
                        <td>{{ $student->class->name }}</td>
                        <td>{{ $student->section->name }}</td>
                        <td>
                            <button class="btn btn-danger btn-sm"
                                onclick="confirm('Are you sure you want to delete this record?') || event.stopImmediatePropagation()"
                                @click="deleteSingleRecord({{ $student->id }})">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="row mt-4">
        <div class="col-sm-6 offset-5">
            {{ $students->links() }}
        </div>
    </div>
</div>
