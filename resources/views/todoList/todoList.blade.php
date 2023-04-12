<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Todo List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
</head>
<body>

<div class="container col-xl-10 col-xxl-8 px-4 py-5">

    {{-- notif validator form--}}
    @if ($errors->any())
        <div class="row">
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger" role="alert">
                    {{$error}}
                </div>
            @endforeach
        </div>
    @endif

    {{-- notif success--}}
    @if (session()->has("success"))
        <div class="row">
            <div class="alert alert-success" role="alert">
                {{ session("success") }}
            </div>
        </div>
    @endif

    {{-- notif error--}}
    @if (session()->has("error"))
        <div class="row">
            <div class="alert alert-danger" role="alert">
                {{ session("error") }}
            </div>
        </div>
    @endif

    {{-- logout --}}
    <div class="row">
        <form method="post" action="/logout">
            @csrf
            <button class="w-15 btn btn-lg btn-danger" type="submit">Sign Out</button>
        </form>
    </div>

    {{-- list todo --}}
    <div class="row align-items-center g-lg-5 py-5">
        <div class="col-lg-7 text-center text-lg-start">
            <h1 class="display-4 fw-bold lh-1 mb-3">Todolist</h1>
        </div>
        <div class="col-md-10 mx-auto col-lg-5">
            <form class="p-4 p-md-5 border rounded-3 bg-light" method="post" action="/todoList_create">
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="todo" placeholder="todo">
                    <label for="todo">Todo</label>
                </div>
                <button class="w-100 btn btn-lg btn-primary" type="submit">Add Todo</button>
            </form>
        </div>
    </div>
    <div class="row align-items-right g-lg-5 py-5">
        <div class="mx-auto">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Todo</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($list_todo as $key => $x)   
                        <tr>
                            <th scope="row">{{ $key+1 }}</th>
                            <td>{{$x->todo}}</td>
                            <td>
                                <form action="/todoList_delete" method="post">
                                    @csrf
                                    <input type="text" class="d-none" name="id" value="{{$x->id}}" />
                                    <button class="w-100 btn btn-lg btn-danger" type="submit">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>