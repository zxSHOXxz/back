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
                        <h3 class="card-title">انشاء صلاحية جديدة</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="create_form">
                        @csrf
                       <div class="card-body">

                            <div class="row">

                                <div class="form-group col-md-6">
                                    <label for="status"> الحالة </label>
                                    <select class="form-control" name="status" style="width: 100%;"
                                        id="status" aria-label=".form-select-sm example">
                                        <option value="active"> active </option>
                                        <option value="reject"> reject </option>

                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="permission_name">  اسم الصلاحية </label>
                                    <input type="text" name="permission_name" class="form-control"
                                        id="permission_name"  placeholder="أدخل اسم الدور الوظيفي  ">
                                </div>
                            </div>

                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="button" onclick="performStore()"
                                    class="btn btn-lg btn-success">حفظ</button>

                                    <a href="{{route('permissions.index')}}" type="submit"
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
            formData.append('status',document.getElementById('status').value);
            formData.append('permission_name',document.getElementById('permission_name').value);

            store('/cms/admin/permissions' ,formData );

        }
        </script>
@endsection
