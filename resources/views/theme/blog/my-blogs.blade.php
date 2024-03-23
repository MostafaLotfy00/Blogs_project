@extends('theme.layout')

@section('title', 'My Blogs')


@section('content')

    @include('theme.partials.hero', ['title' => 'My Blogs'])



    <!-- ================ contact section start ================= -->
    <section class="section-margin--small section-margin">
        <div class="container">
            <div class="row">
                @if (session('delete-status'))
                <div class="alert alert-success">
                    {{ session('delete-status') }}
                </div>
            @endif
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col" width= '15%'>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($blogs) > 0)
                            @foreach ($blogs as $blog)
                                <tr>
                                    <td><a href="{{ route('blogs.show', ['blog' => $blog]) }}"
                                            target="_blank">{{ $blog->name }}</a></td>
                                    <td> <a href="{{ route('blogs.edit', ['blog' => $blog]) }}"
                                            class="btn btn-sm btn-primary mr-2">Edit</a>
                                            {{-- <a href="#"
                                                onclick="document.getElementById('deleteForm').submit(); return false;"
                                                class="btn btn-sm btn-danger mr-2">Delete</a> --}}
                                        <form action="{{ route('blogs.destroy', ['blog' => $blog]) }}" id="editForm"
                                            class="d-inline" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" id="editButton" class="btn btn-sm btn-danger mr-2"> Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                {{ $blogs->render('pagination::bootstrap-4') }}
            </div>
        </div>
    </section>
    <!-- ================ contact section end ================= -->
@endsection
