@extends('layouts.app')
@section('title', 'Mi bandeja')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9">
        {!!Breadcrumbs::render('inbox')!!}
    </div>
</div>
<div class="wrapper wrapper-content">
    <div class="row">
        <tabs-content :rol-id="{{Muserpol\Helpers\Util::getRol()}}" :user="{{Muserpol\Helpers\Util::getAuthUser()}}" :inbox-state="`received`"
            inline-template>
            <div>
                <div class="col-lg-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-content mailbox-content">
                            <div class="file-manager">
                                {{-- <a class="btn btn-block btn-primary compose-mail" ui-sref="email_compose">Compose Mail</a>--}}
                                <div class="space-25"></div>
                                <h5>Trámites</h5>
                                <ul class="folder-list m-b-md" style="padding: 0">
                                    <li>
                                        <a href="{{ url('inbox/received') }}" class="btn-outline" style="border-left:5px solid #59B75C; padding-left:10px; color: #3c3c3c; background:#F8F8F9;font-weight: bold;"> <i class="fa fa-envelope-o "></i> Recibidos
                                            <transition name="fade" mode="out-in" :duration="300" enter-active-class="animated tada" leave-active-class="animated bounceOutRight">
                                                    <span class="label label-warning pull-right" v-if="totalDocs != null" key="value">
                                                        @{{totalDocs}}
                                                    </span>
                                                    <span v-else class="label label-warning pull-right" key="icon" style="padding-left:15px">
                                                        <i  class="fa fa-refresh fa-spin fa-fw" aria-hidden="true"></i>
                                                    </span>
                                            </transition>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('inbox/edited') }}" class="btn-outline"> <i class="fa fa-check"></i> Revisados
                                            <transition name="fade" mode="out-in" :duration="300" enter-active-class="animated tada" leave-active-class="animated bounceOutRight">
                                                    <span class="label label-default pull-right" v-if="documentsEditedTotal != null" key="value">
                                                        @{{documentsEditedTotal}}
                                                    </span>
                                                    <span v-else class="label label-default pull-right" key="icon" style="padding-left:15px">
                                                        <i  class="fa fa-refresh fa-spin fa-fw" aria-hidden="true"></i>
                                                    </span>
                                                </transition>
                                        </a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 animated fadeInRight my-inbox" :class="showLoading ? 'sk-loading' : ''">
                    <div class="mail-box-header">
                        <h2>
                            <span>Recibidos (@{{ totalDocs != null ? totalDocs : 'Inválido' }})</span>
                        </h2>
                        <div class="mail-tools tooltip-demo m-t-md" style="margin-bottom:45px;">
                            <transition name="fade" enter-active-class="animated fadeIn" leave-active-class="animated fadeOut">
                                <div class="col-md-1 text-center" v-if="! docs > 0 ">
                                    <button class="btn btn-default" @click="getData()" data-toggle="tooltip" data-placement="top" title="Actualizar">
                                        Actualizar <i class="fa fa-refresh"></i>
                                    </button>
                                </div>
                            </transition>
                        </div>
                    </div>
                    <div class="mail-box">
                        <div class="sk-folding-cube" v-show="showLoading">
                            <div class="sk-cube1 sk-cube"></div>
                            <div class="sk-cube2 sk-cube"></div>
                            <div class="sk-cube4 sk-cube"></div>
                            <div class="sk-cube3 sk-cube"></div>
                        </div>
                        <vue-tabs>
                            <v-tab :title="`${itab.name} (${classification(itab.id).length})`" v-for="(itab, index) in workflows" :dataId="itab.id" icon="fa fa-file-text-o "
                                :key="`tab-received-${index}`" :suffix="`<span class='badge'> ${classification(itab.id).length} </span>`">
                                <inbox-content :inbox-state="`received`" :workflow-id="itab.id" :documents="classification(itab.id)"></inbox-content>
                            </v-tab>
                        </vue-tabs>
                    </div>
                </div>
            </div>
        </tabs-content>
    </div>
</div>
@endsection
@section('styles')
    {{-- <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet"> --}}
    <link rel="stylesheet" href="{!! asset('css/vuetify.css') !!}" />
@endsection