from django.shortcuts import render, HttpResponse


from .models import Branch


def index(request):
    # latest_question_list = Branch.objects.all()
    # context = {'latest_question_list': latest_question_list}
    return render(request, 'branch/index.html')
# Create your views here.
