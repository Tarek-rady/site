@extends('dashboard.layouts.app')

@section('title', __('models.roles'))

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">{{ __('models.roles') }}</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrumb-right">
                        <div class="dropdown">
                            <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="Click to add a Admin">
                                @if(auth()->user()->hasPermission('roles-create'))
                                    <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">
                                        <span><i class="fa fa-plus"></i></span>
                                        <span> {{ __('models.add_role') }} </span>
                                    </a>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic table -->
                <section id="basic-datatable">

                    <!-- Company Table Card -->
                    <div class="col-lg-12 col-12">
                        <div class="card card-company-table">
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>{{ __('models.roles') }}</th>
                                                <th>{{ __('models.created_at') }}</th>
                                                <th class="text-center">{{ __('models.action') }}</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($roles as $role )

                                            <tr>



                                                <td><span class="badge badge-pill badge-light-primary mr-1">{{ $role->name }}</span></td>


                                                <td>
                                                    <i data-feather="watch" class="font-medium-3"></i>
                                                    {{ $role->created_at->diffForHumans() }}</td>


                                                <td class="text-center">
                                                    <div class="btn-group" role="group" aria-label="Second group">
                                                        @if(auth()->user()->hasPermission('roles-update'))
                                                            <a href="{{ route('admin.roles.edit', $role->id) }}"
                                                                class="btn btn-sm btn-primary"><i
                                                                    class="fa-solid fa-pen-to-square"></i>
                                                            </a>
                                                        @endif

                                                        @if(auth()->user()->hasPermission('roles-delete'))
                                                            <a href="{{ route('admin.roles.destroy', $role->id) }}"
                                                                data-id="{{ $role->id }}"
                                                                class="btn btn-sm btn-danger item-delete"><i
                                                                    class="fa-solid fa-trash-can"></i>
                                                            </a>
                                                        @endif
                                                    </div>
                                                </td>

                                            </tr>

                                            @endforeach


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Company Table Card -->

                </section>
                <!--/ Basic table -->
            </div>
        </div>
    </div>
    <!-- END: Content-->
    @push('js')
      <script src="{{ asset('dashboard/app-assets/js/custom/custom-delete.js') }}"></script>
    @endpush
@endsection
