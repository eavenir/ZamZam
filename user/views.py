from django.shortcuts import render, HttpResponse, redirect
from django.contrib.auth import authenticate, login

# Create your views here.


def login_user(request):
    username = request.POST['username']
    password = request.POST['password']
    user = authenticate(request, username=username, password=password)
    if user is not None:
        login(request, user)
        return HttpResponse('succeded')
        # Redirect to a success page.
        ...
    else:
        # Return an 'invalid login' error message.
        return redirect('welcome')
