@section('head')
    <title>{{ $pageMetaData['title'] }}</title>
    <link rel="canonical" href="{{ url()->current() }}">
    <meta name="description" content="{{ $pageMetaData['description'] }}">
@endsection
<div>
    <h1>{{ $pageContentUrl }}</h1>
</div>
