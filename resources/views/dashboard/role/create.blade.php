@extends('dashboard.master')

@section('title','الصلاحيات ')


@section('styles')

@endsection

@section('content')

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">انشاء دور جديد</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="create_form">
                        @csrf
                       <div class="card-body">

                            <div class="row">

                                <div class="form-group col-md-6">
                                    <label for="username"> الأدوار</label>
                                    <select class="form-control" name="username" style="width: 100%;"
                                        id="username" aria-label=".form-select-sm example">
                                        {{-- <option selected> {{ $admins->user->job_title }} </option> --}}
                                        <option value="admin"> admin </option>
                                        <option value="account"> account </option>

                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="job_name">  اسم الدور </label>
                                    <input type="text" name="job_name" class="form-control"
                                        id="job_name"  placeholder="أدخل اسم الدور الوظيفي  ">
                                </div>
                            </div>

                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="button" onclick="performStore()"
                                    class="btn btn-lg btn-success">حفظ</button>

                                    <a href="{{route('roles.index')}}" type="submit"
                                    class="btn btn-lg btn-secondary">إلغاء</a>
                            </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <!--/.col (left) -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

</section>
<!-- /.content -->

@endsection

@section('scripts')
    <script>
        function performStore(){
            let formData = new FormData();
            formData.append('username',document.getElementById('username').value);
            formData.append('job_name',document.getElementById('job_name').value);

            store('/cms/admin/roles' ,formData );

        }
        </script>
@endsection
