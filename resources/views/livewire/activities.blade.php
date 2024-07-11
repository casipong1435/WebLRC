<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="text-center fs-5">
                            {{ __('Activities') }}
                        </div>
                        
                    </div>
    
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="px-2">
                                <div class="d-flex justify-content-end align-items-center">
                        
                                    <div class="input-group flex-nowrap w-50">
                                        <input id="search" type="text" class="form-control" aria-describedby="addon-wrapping" placeholder="search..." wire:model.live="search_input">
                                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-search"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="container d-flex justify-content-center align-items-center p-2">
                                <table class="w-100 text-center" cellpadding="10">
                                    <thead>
                                        <tr class="border-top border-bottom">
                                            <th>#</th>
                                            <th>Activity</th>
                                            <th>Log Time</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        @if (count($activities) > 0)
                                        @php
                                            $i = 1;
                                        @endphp
                                            @foreach ($activities as $activity)
                                                <tr>
                                                    <td data-label="#">{{$i++}}</td>
                                                    <td data-label="Activity">{{$activity->activity}}</td>
                                                    <td data-label="Log Time">{{Carbon\Carbon::parse($activity->log_time)->format('d F Y g:i a')}}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                                <tr>
                                                    <td colspan="3">No Activities Yet!</td>
                                                </tr>
                                        @endif
                                        
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-end m-2">
                                {{$activities->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div>
