from rest_framework.permissions import IsAuthenticated
from rest_framework import viewsets
from .models import Bracnch, Employee
from . import serializers


class BranchViewSet(viewsets.ModelViewSet):
    """
    API endpoint that allows Company to be viewed or edited.
    """
    permission_classes = [IsAuthenticated]
    queryset = Bracnch.objects.all()
    serializer_class = serializers.BranchSerializer


class EmployeeViewSet(viewsets.ModelViewSet):
    """
    API endpoint that allows Company to be viewed or edited.
    """
    permission_classes = [IsAuthenticated]
    queryset = Employee.objects.all()
    serializer_class = serializers.EmployeeSerializer
