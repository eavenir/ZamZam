from django.urls import path, include
from rest_framework import routers
from user import views

router = routers.DefaultRouter()
router.register(r'user', views.UserViewSet, basename='User')
router.register(r'group', views.GroupViewSet)
router.register(r'permission', views.PermissionViewSet)


urlpatterns = [
    path('', include(router.urls)),
    path('api/logout/', views.LogoutView.as_view(), name='auth_logout'),
]
