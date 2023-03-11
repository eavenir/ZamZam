from django.shortcuts import render
from django.contrib.auth.decorators import login_required
from .models import Branch


@login_required
def index(request):
    return render(request, 'branch/index.html')
# Create your views here.
