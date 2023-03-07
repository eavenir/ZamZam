from django.urls import path, include
from rest_framework import routers
from company import views

router = routers.DefaultRouter()
router.register(r'branch', views.BranchViewSet)
router.register(r'employees', views.EmployeeViewSet)

urlpatterns = [
    path('', include(router.urls)),
]
