<?php
/**
 * Created by PhpStorm.
 * User: Gathem
 * Date: 10/19/2018
 * Time: 7:27 PM
 */ ?>
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2">
            <div class="panel panel-warning">
                <p>&nbsp&nbsp Search By</p>
                <ul>
                    <li><a href="{{url('/search')}}">Question</a></li>
                    <li>Subject</li>
                    <li>Exam Type</li>
                    <li>Year</li>
                </ul>
                </div>
            </div>
            <div class="col-md-8 col-md-">
                @include('flash::message')

                <div class="panel panel-warning">
                    <div class="panel-heading">Questions Details |
                            <a href="{{url('/home')}}"><span class="label label-default">Home</span></a> |
                            <a href="{{url('/flagged')}}"> <span class="label label-info">Flagged</span></a> |
                            <a href="{{url('/search')}}"><span class="label label-info">Search</span></a>
                    <div align="right">@if(!is_null($votes) ){{$votes->up_vote}} <span class="glyphicon glyphicon-ok"></span> | {{$votes->down_vote}} <span class="glyphicon glyphicon-remove"></span> @else <span class="glyphicon glyphicon-ok"></span> | <span class="glyphicon glyphicon-remove"></span> @endif</div>
                    </div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <strong>{!! ucfirst($questionDetails->subject) !!}</strong>
                        <p>{!! $questionDetails->question !!}</p>
                        <p>a) {!! $questionDetails->option_a !!}</p>
                        <p>b) {!! $questionDetails->option_b !!}</p>
                        <p>c) {!! $questionDetails->option_c !!}</p>
                        <p>d) {!! $questionDetails->option_d !!}</p>
                        <p><span class="label label-success"><strong><i>Ans:</i></strong> {!! $questionDetails->answer !!}</span></p>
                         <hr>
                            <p>vote correctness:
                                <a href="{{url('/vote-up/'.$questionDetails->id)}}"><span class="glyphicon glyphicon-ok-circle"></span></a> I
                                <a href="{{url('/vote-down/'.$questionDetails->id)}}"><span class="glyphicon glyphicon-remove-circle"></span></a> </p>
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">Add Comment</button>
                             <!-- Modal -->
                             <div class="modal fade" id="myModal" role="dialog" style="margin-top:25px;">
                                <div class="modal-dialog modal-sm">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      <h4 class="modal-title">Add a comment</h4>
                                    </div>
                                    <div class="modal-body">
                                    <form action="{{ url('/comment-question') }}" method="post" role="form" >
                                          {{--<div class="form-group">--}}
                                            {{--<label for="name">Name:</label>--}}
                                            {{--<input type="text" class="form-control" id="name">--}}
                                          {{--</div>--}}
                                          <div class="form-group">
                                            <label for="comment">Comment:</label>
                                            <textarea class="form-control" rows="5" id="comment" name="comment"></textarea>
                                          </div>
                                          <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                          <input type="hidden" name="question_flag_id" value="{{$questionDetails->id}}">
                                          <button type="submit" class="btn btn-default" id="my-form">Submit</button>
                                    </form>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                        <!-- //Modal -->
                    </div>
                    <div class="panel-body">
                    @if(!$comments->isEmpty())
                        @foreach($comments as $comment)
                        <hr>
                        <p>{{$comment->comment}} </p>
                        <div align="right"> comment by {{ucfirst($comment->user->name)}} <br> {{timeAgo($comment->created_at)}}</div>
                        @endforeach
                    @endif
                    </div>
                    </div>
                </div>
                <div class="col-md-2">
                <div class="panel panel-warning">
                    <p>&nbsp&nbsp Recently Flagged</p>
                    <ul>
                        <li><a href="{{url('flagged/1')}}">What is the meaning of..</a> </li>
                        <li><a href="{{url('flagged/1')}}">When did Nigeria gained inde...</a> </li>
                        <li><a href="{{url('flagged/1')}}">How many apples</a> </li>
                        <li><a href="{{url('flagged/1')}}">Mixtures of two chemical..</a> </li>
                    </ul>

                    <p>&nbsp&nbsp Most Popular</p>
                    <ul>
                        <li>Ajaa...</li>
                        <li>Money.. </li>
                        <li>Hope for Live</li>
                        <li>Year</li>
                    </ul>
                </div>
                </div>
            {{--</div>--}}

        </div>
    </div>
    {{--<script type="text/javascript">--}}
        {{--// Should only be triggered on first page load--}}
        {{--//alert('ho');--}}

        {{--$(function() {--}}
            {{--$('#my-form').on("submit",function(e) {--}}
                {{--e.preventDefault(); // cancel the actual submit--}}

                {{--/* do what you want with the form */--}}

                {{--// Should be triggered on form submit--}}

                {{--alert('hi');--}}
            {{--});--}}
        {{--});--}}
    {{--</script>--}}
@endsection
