@extends('layouts.layout')

@section('title',"FAQ")

@section('content')


<h1 name="h1centre">Frequently Asked Questions</h1>
<button class="btn btn-primary" style="float:right;" type="new" onclick="window.location.href='/admin/faq/create'">Add FAQ</button>
<div style="overflow-x:auto;">
	<table class="table">
        <thead align="center">
            <th style="text-align:left">Status</th>
            <th style="text-align:left" width="850px">Question</th>
            <th >Edit</th>
            <th width="150px">Delete</th>
        </thead>
        <tbody align="center">
            @foreach ($faq as $faq)
                <tr style="">
                    <td style="text-align:left">{{ $faq->status }}</td>
                    <td style="text-align:left"><a title="Answer: {{ $faq->answer }}">{{ str_limit($faq->question, 101) }}</a></td>
                    <td><a href='/admin/faq/{{ $faq->faqID }}/edit'><i class="fas fa-edit"></i></a></td>
                    <td><a href="javascript:;" data-toggle="modal" data-url="{{ route('faq.destroy', $faq->faqID) }}"
                    data-target="#DeleteModal" class="remove-record"><i style="color:#FF0000;" class="fa fa-trash-alt"></i></a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>



@endsection
