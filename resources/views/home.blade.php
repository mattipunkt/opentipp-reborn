<x-layout>
    <h1>
        Startseite
    </h1>
    <div class="row mb-3">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4>
                    Nächste Spiele
                </h4>
                    @foreach ($nextGames as $game)
                        <div>
                            <div class="text-center fw-bold">
                                {{ $game->time->format('d.m.Y,  H:i') }} Uhr
                            </div>
                            <div class="d-flex justify-content-center">
                                <div class="">
                                    {{ $game->team1->name }} 
                                </div>
                                <span> -   </span>
                                <div class="">
                                    {{ $game->team2->name }}
                                </div>
                            </div>
                        </div>
                        <br>
                    @endforeach  
            </div>
        </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6 mb-3 mb-md-0">
            <div class="card">
                <div class="card-body">
                    <h4>Punktetabelle</h4>
                            @foreach($users as $user)
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center">
                                        
                                        <div class="d-flex align-items-center">
                                        <div class="align-middle">
                                            @if($user->profile_picture)
                                            <img src="data:image/jpg;base64,{{ $user->profile_picture }}" class="rounded-circle align-middle" style="height: 40px; object-fit: contain; object-position: 100% 0;margin-right:5px" alt="{{ $user->name }}">
                                            @else
                                            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAAuIwAALiMBeKU/dgAAABl0RVh0U29mdHdhcmUAd3d3Lmlua3NjYXBlLm9yZ5vuPBoAAAMISURBVGiB7djfi5RVHMfxl5YuEvlj3Sx/gBFkkVuWpQSh4a8wKehOFkMMoSC6LFgjiO4kiKK7sOwfKNaL/oCuAgtRQUQEdUV21SJS1HXTtrw4Z5jzrDOz88zzzA7B84YDZ2a+3+/5nGee8z3ne6ioqKj4PzGnS3GX4g28guXxu3H8gp/wZ5fGLY1+fIlJ/NekTeILLOmRxhkZxHnNJzC9ncPasgYv69V6AkcxkHw3hhGcjZ+fwltYmdj8gY0YLUlHIR7ACfUn/Q+GMb+BbR8ORJua/bEYo+fsVxf1L3a34TMUbWt++7olLg/H1AUdyuF3OPH7rQu6crFK9sk+mcN3jew/uaJ0dTnYloi50IH/xcR/axEhc4s4Y1nSv9yB/1jSf7SIkKITuZb0F3fgn26KfxXUUohnZNPuQGvzDI/IpuGnS1eXk1F1MR/n8Psk8Ttfvqz8fKYu6AaebcPnOdxM/D7tmrocLMTv6qKuYFML+83RJrV/uMsa22Y77sruCz8Iu/xgbLvxo+y+cwdbeqC3JUO4rf3T74T2jjM9YQN+NfMkjuLFHmlsmznYhe9wWkgAN2L/W7yue5VpRUXZlPWu9uF5vCQc5R8Xbk/mYVG0uS6k6HHh1HtWqGVO4O+SdHREH97GESGVtpt2G6XhEeyJMWeNBcKZ6moB8c3aVaGmX5BXVN5Xawu+x+oGv03gOE4KB8kx3IoNHoptVfRfh/VNRI/iHfycU19bfIQp2Sd4U6jTdwjrIS/z8Jqwv9yaFnsKHxZWPY3haYNM4qBybwv78bmw8NOxhssaYKdsATSGl8sK3oD1srX8FN4sGvQxIW3Wgp5Rv5TuJsvjWLVxrylY03+dBLsulLazxRqhjq+N/1WngQZkb9XfL0NdTj6QXZdLOwmyLwlySWdZqSjzhTVZ07G3mWGr66DNSX9EOF7MNnfi2DVebWb4YIsg6aIewLsFRXVKf9Jveq3aaiLjSX8otl4zPrPJ/byg2GGw7DYRNTVkprPWIN7T+1vAM/gGp3qso6KioqIk7gFDQi8ogTCjPQAAAABJRU5ErkJggg==" class="rounded-circle align-middle" style="height: 40px; object-fit: contain; object-position: 100% 0;margin-right:5px" alt="{{ $user->name }}">
                                            @endif
                                        </div>
                                        <div class="ml-5 align-middle">
                                            {{ $user->name }}
                                        </div>
                                            
                                        </div>
                                        <div>{{ $user->points }}</div>     
                                </div>
                            </li>
                            @endforeach
                </div>
            </div>
        </div>
        @auth
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Dein Punktestand</h4>
                    <p class="card-text">
                        Du hast gerade {{ Auth::user()->points }} Punkte.
                    </p>
                </div>
            </div>
        </div>
        @endauth
    </div>

</x-layout>