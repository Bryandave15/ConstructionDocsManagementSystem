@extends('layouts.app')

@section('content')
<div class='container'>

    <div class='bg-light mb-2 text-center'>
    <Card className='bg-secondary me-1'>
        <Card.Img variant="top" src="" />
        <Card.Body>
          <Card.Title>For inspection</Card.Title>
          <Card.Text>
             For Inspection Dashboard <br />
            <a href='#'>Inspection</a>
          </Card.Text>
        </Card.Body>
        <Card.Footer>
          <small className="text-muted">Last updated 3 mins ago</small>
        </Card.Footer>
      </Card>
        <div class='bg-secondary me-1 card custom-card'>
            <img class='card-img-top' src='' alt=''>
            <div class='card-body'>
                <h5 class='card-title'>For inspection</h5>
                <p class='card-text'>For Inspection Dashboard <br><a href='#'>Inspection</a></p>
            </div>
            <div class='card-footer'>
                <small class='text-muted'>Last updated 3 mins ago</small>
            </div>
        </div>
        <!-- Other cards -->
    </div>

    <div class='bg-light mb-2 text-center'>
        <div class='bg-secondary me-1 card custom-card'>
            <img class='card-img-top' src='' alt=''>
            <div class='card-body'>
                <h5 class='card-title'>For inspection</h5>
                <p class='card-text'>For Inspection Dashboard <br><a href='#'>Inspection</a></p>
            </div>
            <div class='card-footer'>
                <small class='text-muted'>Last updated 3 mins ago</small>
            </div>
        </div>
        <div class='bg-secondary me-1 card custom-card'>
            <img class='card-img-top' src='' alt=''>
            <div class='card-body'>
                <h5 class='card-title'>For inspection</h5>
                <p class='card-text'>For Inspection Dashboard <br><a href='#'>Inspection</a></p>
            </div>
            <div class='card-footer'>
                <small class='text-muted'>Last updated 3 mins ago</small>
            </div>
        </div>
        <!-- Other cards -->
    </div>

    <!-- More card groups -->

    <div class='card-group'>
        <div class='text-center card'>
            <div class='card-header'>Newly Added</div>
            <div class='card-body'>
                <h5 class='card-title' style='border-bottom:2px solid black'>Latest Added from Tools</h5>
            </div>
        </div>
    </div>

</div>
@endsection
