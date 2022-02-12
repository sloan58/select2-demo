@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-4 mx-auto">
            <label for="select2-users">Users</label>
            <select id="select2-users" class="form-control" name="user"></select>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#select2-users').select2({
            delay: 250,
            ajax: {
                url: '/users',
                data: function (params) {
                    return {
                        q: params.term,
                        page: params.page || 1,
                    }
                },
                processResults: function (data, params) {
                    params.current_page = data.current_page;
                    return {
                        results: $.map(data.data, function (item) {
                            return {
                                id: item.id,
                                text: item.name,
                            }
                        }),
                        pagination: {
                            more: (params.current_page * 30) < data.total
                        }
                    };
                }
            }
        });
    });
</script>
@endsection
