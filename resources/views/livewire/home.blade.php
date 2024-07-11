<div>

    @php
        use Carbon\Carbon;
        use Illuminate\Support\Facades\Crypt;
    @endphp

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="text-center fs-5">
                            {{ __('Learning Materials') }}
                        </div>
                        
                    </div>
    
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="col-md-12 mb-1">
                            <div class="px-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addbook">+ Add</button>
                                        <button class="btn btn-primary rounded" data-bs-toggle="modal" data-bs-target="#generateReport"><i class="bi bi-printer-fill"></i></button>
                                    </div>
                                    <div class="input-group flex-nowrap w-50">
                                        <input id="search" type="text" class="form-control" aria-describedby="addon-wrapping" placeholder="search..." wire:model.live="search_input">
                                        <span class="input-group-text" id="addon-wrapping"><i class="bi bi-search"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="px-2">
                                <div class="d-flex justify-content-end align-item-center">
                                    <div class="d-inline-block">
                                        <span class="fw-bold">Filters: </span>
                                        <select id="" class="p-2 m-1" wire:model.live="location_filter">
                                            <option disabled>Location</option>
                                            <option value="">All</option>
                                            @if (count($genres) > 0)
                                                @foreach ($genres as $genre)
                                                    <option value="{{$genre->genre}}">{{$genre->genre}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <select id="" class="p-2 m-1" wire:model.live="program_filter">
                                            <option disabled>Program</option>
                                            <option value="">All</option>
                                            @if (count($programs) > 0)
                                                @foreach ($programs as $program)
                                                        <option value="{{$program->program}}">{{$program->program}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="container d-flex justify-content-center align-items-center p-2">
                                <table class="w-100 text-center" cellpadding="10">
                                    <thead>
                                        <tr class="border-top border-bottom">
                                            <th>Accession #</th>
                                            <th>Date Acquired</th>
                                            <th>Author</th>
                                            <th>Title</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        @if (count($books) > 0)
                                            @foreach ($books as $book)
                                                <tr>
                                                    <td data-label="Accession #">{{$book->accession_number}}</td>
                                                    <td data-label="Date Acquired">{{$book->date_acquired}}</td>
                                                    <td data-label="Author">{{$book->author}}</td>
                                                    <td data-label="Title">{{$book->title}}</td>
                                                    <td data-label="Status" class="{{$book->status == 0 ? 'text-warning':'text-success'}}">{{$book->status == 0 ? 'Archived':'Active'}}</td>
                                                    <td>
                                                        <button class="btn p-1 btn-outline-primary" wire:click="getBookId('{{Crypt::encrypt($book->accession_number)}}')" data-bs-toggle="modal" data-bs-target="#editBook">
                                                            <i class="bi bi-three-dots"></i>
                                                        </button>
                                                        <button class="btn p-1 btn-{{$book->status == 0 ? '':'outline-'}}warning" data-bs-toggle="modal" data-bs-target="#archiveBook" wire:click="getBookId('{{Crypt::encrypt($book->accession_number)}}')">
                                                            <i class="bi bi-archive"></i>
                                                        </button>
                                                        <button class="btn p-1 btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteBook" wire:click="getBookId('{{Crypt::encrypt($book->accession_number)}}')">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                                <tr>
                                                    <td colspan="6">No Learning Materials Added Yet!</td>
                                                </tr>
                                        @endif
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <!-- Add Modal -->
    <div wire:ignore.self class="modal fade" id="addbook" tabindex="-1" aria-labelledby="addbookLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addbookLabel">Add Learning Material</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="addBook">
                @csrf
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="container p-2">
                                    <div class="mb-3">

                                        <div class="form-outline">
                                            <label class="form-label" for="title">Title</label>
                                            <input type="text" id="title" wire:model="title" class="form-control p-2 @error('title') is-invalid @enderror" />
                                        </div>
                                        @error('title')
                                            <div class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-outline">
                                            <label class="form-label" for="author">Author</label>
                                            <input type="text" id="author" wire:model="author" class="form-control p-2 @error('author') is-invalid @enderror" /> 
                                        </div>
                                        @error('author')
                                            <div class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-outline">
                                            <label class="form-label" for="date_acquired">Date Acquired</label>
                                            <input type="date" id="date_acquired" wire:model="date_acquired" class="form-control p-2 @error('date_acquired') is-invalid @enderror" />
                                        </div>
                                        @error('date_acquired')
                                            <div class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-outline">
                                            <label class="form-label" for="funding_source">Funding Source</label>
                                            <input type="text" id="funding_source" wire:model="funding_source" class="form-control p-2" />
                                        </div>
                                    
                                    </div>
                                    <div class="mb-3">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-outline">
                                                        <label class="form-label" for="edition">Edition</label>
                                                        <input type="text" id="edition" wire:model="edition" class="form-control  p-2" />
                                                    </div>
                                                    
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-outline">
                                                        <label class="form-label" for="volume">Volume #</label>
                                                        <input type="text" id="volume" wire:model="volume" class="form-control p-2" />         
                                                    </div>
                                                    
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-outline">
                                                        <label class="form-label" for="extent">Extent</label>
                                                        <input type="text" id="extent" wire:model="extent" class="form-control p-2" />
                                                    </div>
                                                
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-outline">
                                            <label class="form-label" for="purchase_price">Purchase Price</label>
                                            <input type="number" id="purchase_price" wire:model="purchase_price" class="form-control p-2" />
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                            <div class="col-md-6">
                                <div class="container p-2">
                                    
                                    <div class="mb-3">
                                        <div class="form-outline">
                                            <label class="form-label" for="publisher">Publisher</label>
                                            <input type="text" id="publisher" wire:model="publisher" class="form-control  p-2" />
                                        </div>
                                        
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-outline">
                                            <label class="form-label" for="publication_year">Publication Year</label>
                                            <input type="number" id="publication_year" wire:model="publication_year" class="form-control p-2" placeholder="YYYY" min="1000" max="{{Carbon::now('Asia/Manila')->format('Y')}}"/>
                                        </div>
                                        
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-outline">
                                            <label class="form-label" for="location">Location</label>
                                            <select class="form-control p-2 @error('location') is-invalid @enderror" id="location" wire:model="location" >
                                                <option value="" disabled>Select Location</option>
                                                @if (count($genres) > 0)
                                                    @foreach ($genres as $genre)
                                                        <option value="{{$genre->genre}}">{{$genre->genre}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            
                                        </div>
                                        @error('location')
                                            <div class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-outline">
                                            <label class="form-label" for="program">Program</label>
                                            <div class="input-group flex-nowrap">
                                                <input type="text" id="program_list" wire:model="program_list" class="form-control p-2 @error('program_list') is-invalid @enderror" data-bs-toggle="dropdown" aria-expanded="false" readonly/>
                                                <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="inside"></button>

                                                <ul class="dropdown-menu w-100 px-2" aria-labelledby="dropdownMenuButton1" >
                                                    <li class="me-2">Select Program</li>
                                                    @if (count($programs) > 0)
                                                        @foreach ($programs as $program)
                                                        <li>
                                                            <input type="checkbox" class="me-1" id="{{$program->program}}" value="{{$program->program}}" wire:model.live="program">
                                                            <label for="{{$program->program}}">{{$program->program}}</label>
                                                        </li>
                                                        @endforeach
                                                    @endif
                                                  </ul>
                                            </div>
                                            
                                            
                                            
                                        </div>
                                        @error('program_list')
                                            <div class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-outline">
                                            <label class="form-label" for="course_title">Course Title</label>
                                            <input type="text" id="course_title" wire:model="course_title" class="form-control p-2" />
                                            
                                        </div>
                                        
                                    
                                    </div>
                                    <div class="mb-3">
                                       <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-outline">
                                                    <label class="form-label" for="course_code">Course Code</label>
                                                    <input type="text" id="course_code" wire:model="course_code" class="form-control p-2" />
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-outline">
                                                    <label class="form-label" for="remarks">Remarks</label>
                                                    <input type="text" id="remarks" wire:model="remarks" class="form-control p-2" />
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-outline">
                                                    <label class="form-label " for="isbn">ISBN</label>
                                                    <input type="text" id="isbn" wire:model="isbn" class="form-control p-2 @error('isbn') is-invalid @enderror" /> 
                                                </div>
                                                @error('isbn')
                                                    <div class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                       </div>
                                    
                                    </div>
                                </div>
                            </div>
    
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-outline-primary">Add Now</button>
                </div>
            </form>
          </div>
        </div>
    </div>

     <!-- More Details Modal -->
    <div wire:ignore.self class="modal fade" id="editBook" tabindex="-1" aria-labelledby="editBookLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="editBookLabel">Learning Material Details</h5>
              <button type="button" class="btn-close close-modal" data-bs-dismiss="modal" aria-label="Close" wire:click="resetFields"></button>
            </div>
            <form wire:submit.prevent="saveEdit">
                @csrf
                <div class="modal-body">
                    <div class="text-center" wire:loading wire:target="getBookDetails">
                        <div class="spinner-border" role="status">
                          <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    <div class="col-md-12" wire:loading.remove wire:target="getBookDetails">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="container p-2">
                                    <div class="mb-3">

                                        <div class="form-outline">
                                            <label class="form-label" for="title">Title</label>
                                            <input type="text" id="title" wire:model="title" class="form-control p-2 @error('title') is-invalid @enderror" {{$isEdit ? '':'disabled'}} />
                                        </div>
                                        @error('title')
                                            <div class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-outline">
                                            <label class="form-label" for="author">Author</label>
                                            <input type="text" id="author" wire:model="author" class="form-control p-2 @error('author') is-invalid @enderror" {{$isEdit ? '':'disabled'}} /> 
                                        </div>
                                        @error('author')
                                            <div class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-outline">
                                            <label class="form-label" for="date_acquired">Date Acquired</label>
                                            <input type="date" id="date_acquired" wire:model="date_acquired" class="form-control p-2 @error('date_acquired') is-invalid @enderror" {{$isEdit ? '':'disabled'}} />
                                        </div>
                                        @error('date_acquired')
                                            <div class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-outline">
                                            <label class="form-label" for="funding_source">Funding Source</label>
                                            <input type="text" id="funding_source" wire:model="funding_source" class="form-control p-2" {{$isEdit ? '':'disabled'}} />
                                        </div>
                                    
                                    </div>
                                    <div class="mb-3">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-outline">
                                                        <label class="form-label" for="edition">Edition</label>
                                                        <input type="text" id="edition" wire:model="edition" class="form-control  p-2" {{$isEdit ? '':'disabled'}} />
                                                    </div>
                                                    
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-outline">
                                                        <label class="form-label" for="volume">Volume #</label>
                                                        <input type="text" id="volume" wire:model="volume" class="form-control p-2" {{$isEdit ? '':'disabled'}} />         
                                                    </div>
                                                    
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-outline">
                                                        <label class="form-label" for="extent">Extent</label>
                                                        <input type="text" id="extent" wire:model="extent" class="form-control p-2" {{$isEdit ? '':'disabled'}} />
                                                    </div>
                                                
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-outline">
                                            <label class="form-label" for="purchase_price">Purchase Price</label>
                                            <input type="number" id="purchase_price" wire:model="purchase_price" class="form-control p-2" {{$isEdit ? '':'disabled'}} />
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
    
                            <div class="col-md-6">
                                <div class="container p-2">
                                    
                                    <div class="mb-3">
                                        <div class="form-outline">
                                            <label class="form-label" for="publisher">Publisher</label>
                                            <input type="text" id="publisher" wire:model="publisher" class="form-control  p-2" {{$isEdit ? '':'disabled'}} />
                                        </div>
                                        
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-outline">
                                            <label class="form-label" for="publication_year">Publication Year</label>
                                            <input type="number" id="publication_year" wire:model="publication_year" class="form-control p-2" placeholder="YYYY" min="1000" max="{{Carbon::now('Asia/Manila')->format('Y')}}" {{$isEdit ? '':'disabled'}}/>
                                        </div>
                                        
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-outline">
                                            <label class="form-label" for="location">Location</label>
                                            <select class="form-control p-2 @error('location') is-invalid @enderror" id="location" wire:model="location" {{$isEdit ? '':'disabled'}}>
                                                <option value="" disabled>Select Location</option>
                                                @if (count($genres) > 0)
                                                    @foreach ($genres as $genre)
                                                        <option value="{{$genre->genre}}">{{$genre->genre}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        @error('location')
                                            <div class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-outline">
                                            <label class="form-label" for="program">Program</label>
                                            <div class="input-group flex-nowrap ">
                                                <input type="text" id="program_list" {{$isEdit ? '':'disabled'}} wire:model="program_list" class="form-control p-2 @error('program_list') is-invalid @enderror" data-bs-toggle="dropdown" aria-expanded="false" readonly/>
                                                <button class="btn btn-outline-primary dropdown-toggle {{$isEdit ? '':'disabled'}}" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="inside"></button>

                                                <ul class="dropdown-menu w-100 px-2" aria-labelledby="dropdownMenuButton1" >
                                                    <li class="me-2">Select Program</li>
                                                    @if (count($programs) > 0)
                                                        @foreach ($programs as $program)
                                                        <li>
                                                            <input type="checkbox" class="me-1" id="{{$program->program}}" value="{{$program->program}}" wire:model.live="program">
                                                            <label for="{{$program->program}}">{{$program->program}}</label>
                                                        </li>
                                                        @endforeach
                                                    @endif
                                                  </ul>
                                            </div>
                                            
                                            
                                            
                                        </div>
                                        @error('program_list')
                                            <div class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-outline">
                                            <label class="form-label" for="course_title">Course Title</label>
                                            <input type="text" id="course_title" wire:model="course_title" class="form-control p-2" {{$isEdit ? '':'disabled'}} />
                                            
                                        </div>
                                    
                                    </div>
                                    <div class="mb-3">
                                       <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-outline">
                                                    <label class="form-label" for="course_code">Course Code</label>
                                                    <input type="text" id="course_code" wire:model="course_code" class="form-control p-2" {{$isEdit ? '':'disabled'}} />
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-outline">
                                                    <label class="form-label" for="remarks">Remarks</label>
                                                    <input type="text" id="remarks" wire:model="remarks" class="form-control p-2" {{$isEdit ? '':'disabled'}} />
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-outline">
                                                    <label class="form-label @error('isbn') is-invalid @enderror" for="isbn">ISBN</label>
                                                    <input type="text" id="isbn" wire:model="isbn" class="form-control p-2" {{$isEdit ? '':'disabled'}} />
                                                    
                                                </div>
                                                @error('isbn')
                                                    <div class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                       </div>
                                    
                                    </div>
                                </div>
                            </div>
    
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    @if (!$isEdit)
                    <button type="button" class="btn btn-outline-secondary close-modal" data-bs-dismiss="modal" wire:click="resetFields">Close</button>
                    <button type="button" class="btn btn-outline-primary" wire:click="EditOrUnedit">Edit</button>
                    @else
                    <button type="button" class="btn btn-outline-secondary" wire:click="EditOrUnedit">Cancel</button>
                    <button type="submit" class="btn btn-outline-primary">Save</button>
                    @endif
                </div>
            </form>
          </div>
        </div>
    </div>


    <div wire:ignore.self class="modal fade" id="archiveBook" tabindex="-1" aria-labelledby="archiveBookLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="archiveBookLabel">Archive Learning Material</h5>
              <button type="button" class="btn-close close-modal" data-bs-dismiss="modal" aria-label="Close" wire:click="resetFields"></button>
            </div>
            <form wire:submit.prevent="changeBookStatus">
                @csrf
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="container text-center d-flex flex-column">
                                <div class="text-warning fs-1"><i class="bi bi-info-circle"></i></div>
                                <div class="fs-4">Click "Yes" to confirm the action. </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-secondary close-modal" data-bs-dismiss="modal" wire:click="resetFields">Cancel</button>
                  <button type="submit" class="btn btn-outline-warning">Yes</button>
                </div>
            </form>
          </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="deleteBook" tabindex="-1" aria-labelledby="deleteBookLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="deleteBookLabel">Delete Learning Material</h5>
              <button type="button" class="btn-close close-modal" data-bs-dismiss="modal" aria-label="Close" wire:click="resetFields"></button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="row">
                        <div class="container text-center d-flex flex-column">
                            <div class="text-danger fs-1"><i class="bi bi-info-circle"></i></div>
                            <div class="fs-4">Are you sure you want to delete this learning material? </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary close-modal" data-bs-dismiss="modal">No</button>
              <button type="button" class="btn btn-outline-danger" wire:click="deleteBook">Yes</button>
            </div>
          </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="generateReport" tabindex="-1" aria-labelledby="generateReportLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="generateReportLabel">Generate Report</h5>
              <button type="button" class="btn-close close-modal" data-bs-dismiss="modal" aria-label="Close" wire:click="resetFields"></button>
            </div>
            <form wire:submit.prevent="findData">
                @csrf
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="mb-2">
                                <label for="date_acquired_from">Select Report Type</label>
                                <select class="p-2 form-control mt-1" id="report_type" wire:model.live="report_type">
                                    <option value="0">Book Accession Data</option>
                                    <option value="1">List of Professional Books</option>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label for="date_acquired_from">Date Acquired From:</label>
                                <input type="date" class="p-2 form-control mt-1 @error('date_acquired_from') is-invalid @enderror" id="date_acquired_from" wire:model="date_acquired_from">
                                @error('date_acquired_from')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="date_acquired_from">Date Acquired To:</label>
                                <input type="date" class="p-2 form-control mt-1 @error('date_acquired_to') is-invalid @enderror" id="date_acquired_from" wire:model="date_acquired_to">
                                @error('date_acquired_to')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="location_report">Location</label>
                                <select id="location_report" class="p-2 mt-1 w-100" wire:model="location_report">
                                    <option value="">All</option>
                                    @if (count($genres) > 0)
                                        @foreach ($genres as $genre)
                                            <option value="{{$genre->genre}}">{{$genre->genre}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="mb-2">
                                <label for="program_report">Program</label>
                                <select id="program_report" class="p-2 mt-1 w-100" wire:model="program_report">
                                    <option value="">All</option>
                                    @if (count($programs) > 0)
                                        @foreach ($programs as $program)
                                            <option value="{{$program->program}}">{{$program->program}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            @if (session()->has('found'))
                                <div class="mb-2">
                                    <div class="alert alert-success alert-dismissible fade show position-relative" role="alert">
                                        <strong>Report!</strong> {{session()->get('found')}}
                                        <div class="position-absolute" style="top: 0; right: 1rem; font-size: 2rem">
                                            <a target="_blank" href="{{route('printReport', ['data' => Crypt::encrypt(json_encode($search_data))])}}"><i class="bi bi-file-earmark"></i></a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if (session()->has('no-found'))
                                <div class="mb-2">
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <strong>Report!</strong> {{session()->get('no-found')}}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                      </div>
                                </div>
                            @endif
                            @if (session()->has('error'))
                                <div class="mb-2">
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Report!</strong> {{session()->get('erorr')}}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                      </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-secondary close-modal" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-outline-primary"><i class="bi bi-search me-1"></i>Find</button>
                </div>
            </form>
          </div>
        </div>
    </div>
       

        <!--Toast-->
        @include('layouts.toaster')


        <script>
            
            window.addEventListener('add_clicked', function(){
                const toastLiveExample = document.getElementById('liveToast')

                const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
                toastBootstrap.show()
            });

            window.addEventListener('hide_modal', function(){
                $('button.close-modal').click();
            });

        </script>
</div>
