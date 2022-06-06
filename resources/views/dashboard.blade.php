<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="container">
            <div class="bg-white p-4 rounded-3">
                <div class="text-end mb-2">
                    <a href="{{ route('userAmount.delete') }}" method="post">Delete All</a>
                </div> 
                @if(!$prices->isEmpty())
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Amount</th>
                                <th scope="col">User Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($prices as $price)
                            <tr>
                                <th scope="row">{{$loop->index + 1}}</th>
                                <td>{{ $price->amount }}</td>
                                <td>
                                    <ul>
                                        @foreach($price->userAmount as $userAmount)
                                            <li><strong>{{ $userAmount->user->name }}</strong>: {{ $userAmount->amount }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <h4 class="text-muted text-center">Empty</h4>
                @endif
            </div>

            <div class="bg-white mt-5 p-4 rounded-3">
                <div class="row justify-center">
                    <div class="col-md-6">
                        <form action="{{ route('userAmount.save') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" name="price" class="form-control" id="price">
                                @error('price') <small class="text-danger">{{ $errors->first('price') }}</small> @enderror
                            </div>

                            @if($prices->isEmpty())
                                <div class="mt-5 bg-light p-4 rounded-3">
                                    @foreach($users as $user)
                                        <div class="form-group mb-4">
                                            <label for="user-{{$user->id}}" class="form-label">{{ $user->name }}</label>
                                            <input type="hidden" name="users[]" value="{{$user->id}}" class="form-control">
                                            <input type="text" class="form-control" name="amounts[]" id="user-{{$user->id}}">
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-primary text-dark">Save</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
