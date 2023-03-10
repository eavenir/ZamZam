from django.shortcuts import render

# Create your views here.


from django.contrib.auth.models import User, Group, Permission
from django.shortcuts import get_object_or_404
from rest_framework import permissions
from rest_framework import viewsets
from rest_framework.views import APIView
from rest_framework_simplejwt.tokens import RefreshToken
from rest_framework.response import Response
from rest_framework import status
from . import serializers


# class IsOwnerOrReadOnly(permissions.BasePermission):
#     """
#     Custom permission to only allow owners of an object to edit it.
#     """

#     def has_object_permission(self, request, view, obj):
#         # Read permissions are allowed to any request,
#         # so we'll always allow GET, HEAD or OPTIONS requests.
#         if request.method in permissions.SAFE_METHODS:
#             return True

#         # Write permissions are only allowed to the owner of the snippet.
#         return obj.is_superuser == True


class UserViewSet(viewsets.ModelViewSet):
    """
    API endpoint that allows users to be viewed or edited.
    """
    permission_classes = [permissions.IsAuthenticated]
    serializer_class = serializers.UserSerializer

    def get_queryset(self):
        user = self.request.user
        if (user.is_superuser == True):
            return User.objects.all()
        else:
            return User.objects.filter(id=user.id)


class LogoutView(APIView):

    def post(self, request):
        try:
            refresh_token = request.data["refresh_token"]
            token = RefreshToken(refresh_token)
            token.blacklist()

            return Response(status=status.HTTP_205_RESET_CONTENT)
        except Exception as e:
            return Response(status=status.HTTP_400_BAD_REQUEST)


class GroupViewSet(viewsets.ModelViewSet):
    """
    API endpoint that allows Groups to be viewed or edited.
    """
    permission_classes = [permissions.IsAuthenticated]
    queryset = Group.objects.all()
    serializer_class = serializers.GroupSerializer


class PermissionViewSet(viewsets.ModelViewSet):
    """
    API endpoint that allows Permissions to be viewed or edited.
    """
    permission_classes = [permissions.IsAuthenticated]
    queryset = Permission.objects.all()
    serializer_class = serializers.PermissionSerializer
