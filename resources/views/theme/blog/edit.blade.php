@extends('theme.layout')

@section('title', 'Edit Blog')


@section('content')

    @include('theme.partials.hero', ['title' => $blog->name])



    <!-- ================ contact section start ================= -->
    <section class="section-margin--small section-margin">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @if (session('blog_status'))
                        <div class="alert alert-success">
                            {{ session('blog_status') }}
                        </div>
                    @endif
                    <form action="{{ route('blogs.update', ['blog' => $blog]) }}" class="form-contact contact_form"
                        method="post" enctype="multipart/form-data" novalidate="novalidate">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <input class="form-control border" name="name" value="{{ $blog->name }}" type="text"
                                placeholder="Enter the blog title name">
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div class="form-group">
                            <input class="form-control border" name="image" type="file">
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>

                        <div class="form-group">
                            <select class="form-control border" name="category_id" value="{{ old('category_id') }}"
                                placeholder="Enter the blog title name">
                                <option value="">Select Blog Category</option>
                                @if (count($categories) > 0)

                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @if ($category->id == $blog->category_id) selected @endif>
                                            {{ $category->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                        </div>

                        <div class="form-group">
                            <textarea class="w-100 border" rows="5" name="description" placeholder="Enter the blog description">{{ $blog->description }}</textarea>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>


                        <div class="form-group text-center text-md-right mt-3">
                            <button type="submit" class="button button--active button-contactForm">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ contact section end ================= -->
@endsection
