<x-layout>
    <div class="d-flex justify-content-between">
        <h1>
            Punktetabelle
        </h1>    
    </div>

    <br>
    <p>
        Bitte beachte, dass die Punkte nur alle <b>30 Minuten</b> aktualisiert werden. Es kann also sein, dass
        du erst später deinen Sieg begutachten kannst.
    </p>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <div class="d-flex justify-content-between">
                <b>Nutzername</b>
                <b>Punkte</b>
            </div>
        </li>
        @foreach($users as $user)
        <li class="list-group-item">
            <a href="/user/{{ $user->name }}" class="link-body-emphasis link-offset-2 link-underline link-underline-opacity-0">
            <div class="d-flex justify-content-between align-items-center">
                    
                    <div class="d-flex align-items-center">
                    <div class="align-middle">
                        @if($user->profile_picture)
                        <img src="data:image/jpg;base64,{{ $user->profile_picture }}" class="rounded-circle align-middle" style="height: 40px; object-fit: contain; object-position: 100% 0;margin-right:5px" alt="{{ $user->name }}">
                        @else
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAAuIwAALiMBeKU/dgAAABl0RVh0U29mdHdhcmUAd3d3Lmlua3NjYXBlLm9yZ5vuPBoAAAMISURBVGiB7djfi5RVHMfxl5YuEvlj3Sx/gBFkkVuWpQSh4a8wKehOFkMMoSC6LFgjiO4kiKK7sOwfKNaL/oCuAgtRQUQEdUV21SJS1HXTtrw4Z5jzrDOz88zzzA7B84YDZ2a+3+/5nGee8z3ne6ioqKj4PzGnS3GX4g28guXxu3H8gp/wZ5fGLY1+fIlJ/NekTeILLOmRxhkZxHnNJzC9ncPasgYv69V6AkcxkHw3hhGcjZ+fwltYmdj8gY0YLUlHIR7ACfUn/Q+GMb+BbR8ORJua/bEYo+fsVxf1L3a34TMUbWt++7olLg/H1AUdyuF3OPH7rQu6crFK9sk+mcN3jew/uaJ0dTnYloi50IH/xcR/axEhc4s4Y1nSv9yB/1jSf7SIkKITuZb0F3fgn26KfxXUUohnZNPuQGvzDI/IpuGnS1eXk1F1MR/n8Psk8Ttfvqz8fKYu6AaebcPnOdxM/D7tmrocLMTv6qKuYFML+83RJrV/uMsa22Y77sruCz8Iu/xgbLvxo+y+cwdbeqC3JUO4rf3T74T2jjM9YQN+NfMkjuLFHmlsmznYhe9wWkgAN2L/W7yue5VpRUXZlPWu9uF5vCQc5R8Xbk/mYVG0uS6k6HHh1HtWqGVO4O+SdHREH97GESGVtpt2G6XhEeyJMWeNBcKZ6moB8c3aVaGmX5BXVN5Xawu+x+oGv03gOE4KB8kx3IoNHoptVfRfh/VNRI/iHfycU19bfIQp2Sd4U6jTdwjrIS/z8Jqwv9yaFnsKHxZWPY3haYNM4qBybwv78bmw8NOxhssaYKdsATSGl8sK3oD1srX8FN4sGvQxIW3Wgp5Rv5TuJsvjWLVxrylY03+dBLsulLazxRqhjq+N/1WngQZkb9XfL0NdTj6QXZdLOwmyLwlySWdZqSjzhTVZ07G3mWGr66DNSX9EOF7MNnfi2DVebWb4YIsg6aIewLsFRXVKf9Jveq3aaiLjSX8otl4zPrPJ/byg2GGw7DYRNTVkprPWIN7T+1vAM/gGp3qso6KioqIk7gFDQi8ogTCjPQAAAABJRU5ErkJggg==" class="rounded-circle align-middle" style="height: 40px; object-fit: contain; object-position: 100% 0;margin-right:5px" alt="{{ $user->name }}">
                        @endif
                    </div>
                    <div class="ml-6 align-middle">
                        {{ $user->name }}
                    </div>
                        
                    </div>
                    <div>{{ $user->points }}</div>     
            </div>
        </a>
        </li>
        @endforeach
      </ul>
</x-layout>