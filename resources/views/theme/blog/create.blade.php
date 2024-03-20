@extends('theme.layout')

@section('title', 'Add New Blog')


@section('content')

    @include('theme.partials.hero', ['title' => 'Add New Blog'])



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
                    <form action="{{ route('blogs.store') }}" class="form-contact contact_form" method="post"
                        enctype="multipart/form-data" novalidate="novalidate">
                        @csrf
                        <div class="form-group">
                            <input class="form-control border" name="name" value="{{ old('name') }}" type="text"
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
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                        </div>

                        <div class="form-group">
                            <textarea class="w-100 border" rows="5" name="description" placeholder="Enter the blog description">{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>


                        <div class="form-group text-center text-md-right mt-3">
                            <button type="submit" class="button button--active button-contactForm">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ contact section end ================= -->
@endsection
