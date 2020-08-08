<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">{{$data['header']}}</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                {{$data['text']}}
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                @if ($data['type']== 1)
                <form method="POST" action="{{route($data['button']['route'], $data['button']['req'])}}">
                    @csrf
                    <input type="hidden" name="_method" value="{{$data['formmethod']}}">
                    <input type="submit" value="{{$data['button']['text']}}" class="btn btn-danger">
                    <button type="button" class="btn btn-light" data-dismiss="modal">No</button>
                </form>
                @else
                <button type="button" class="btn btn-info" data-dismiss="modal">Ok</button>
                @endif
            </div>

        </div>
    </div>
</div>