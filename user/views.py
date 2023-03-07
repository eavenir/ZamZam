from django.shortcuts import render

# Create your views here.


from django.contrib.auth.models import User, Group, Permission
from rest_framework.permissions import IsAuthenticated
from rest_framework import viewsets
from . import serializers


class UserViewSet(viewsets.ModelViewSet):
    """
    API endpoint that allows users to be viewed or edited.
    """
    permission_classes = [IsAuthenticated]
    queryset = User.objects.all()
    serializer_class = serializers.UserSerializer


class GroupViewSet(viewsets.ModelViewSet):
    """
    API endpoint that allows Groups to be viewed or edited.
    """
    permission_classes = [IsAuthenticated]
    queryset = Group.objects.all()
    serializer_class = serializers.GroupSerializer


class PermissionViewSet(viewsets.ModelViewSet):
    """
    API endpoint that allows Permissions to be viewed or edited.
    """
    permission_classes = [IsAuthenticated]
    queryset = Permission.objects.all()
    serializer_class = serializers.PermissionSerializer
