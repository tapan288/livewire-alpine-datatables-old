<div>
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
                    <select class="form-control form-control-sm">
                        <option value="">All Class</option>
                    </select>
                </div>
            </div>

            <div>
                <div class="d-flex align-items-center ms-4">
                    <label for="paginate" class="text-nowrap me-2 mb-0">Section</label>
                    <select class="form-control form-control-sm">
                        <option value="">Select a Section</option>
                    </select>
                </div>
            </div>

            <div class="dropdown ms-4" x-show="checked.length > 0">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    With Checked (1)
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a href="#" class="dropdown-item" type="button">
                            Delete
                        </a>
                    </li>
                    <li><a href="#" class="dropdown-item" type="button">
                            Export
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-md-4">
            <input type="search" class="form-control" placeholder="Search by name,email,phone,or address...">
        </div>
    </div>

    <div class="col-md-12 my-3">
        {{-- include flash messages here --}}
    </div>

    <br>

    <div class="col-md-10 mb-3">
        <div>
            You are currently selecting <strong>4</strong> items.
        </div>
        <div>
            You have selected <strong>4</strong> items, Do you want to Select All
            <strong>100</strong> items?
            <a href="#" class="ml-2">Select All</a>
        </div>
    </div>

    <div class="card-body table-responsive p-0">
        <table class="table table-hover">
            <tbody>
                <tr>
                    <th><input type="checkbox" x-model="selectPage"></th>
                    <th>
                        <a href="#">
                            Student's Name
                        </a>
                    </th>
                    <th>
                        <a href="#">
                            Email
                        </a>
                    </th>
                    <th>
                        <a href="#">
                            Address
                        </a>
                    </th>
                    <th>
                        <a href="#">
                            Phone Number
                        </a>
                    </th>
                    <th>Class</th>
                    <th>Section</th>
                    <th>Action</th>
                </tr>
                @foreach ($students as $student)
                    <tr>
                        <td>
                            <input type="checkbox" />
                        </td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->address }}</td>
                        <td>{{ $student->phone_number }}</td>
                        <td>{{ $student->class->name }}</td>
                        <td>{{ $student->section->name }}</td>
                        <td>
                            <button class="btn btn-danger btn-sm">
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
