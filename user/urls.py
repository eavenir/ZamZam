from django.urls import path
from django.views.generic import TemplateView
from .views import login, login_user
urlpatterns = [
    path("", TemplateView.as_view(template_name="user/login.html"), name="welcome"),
    path("login", login_user, name="login")
]
