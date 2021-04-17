{{--@extends('layouts.admin')--}}

{{--@section('content')--}}
   <div class="row">
       <div>
           {{$result['ReasonCodeDesc']}}
       </div>
       <a href="http://127.0.0.1:8000/home/payment">
           <el-button>
               Return
           </el-button>
       </a>
   </div>
{{--@endsection--}}
