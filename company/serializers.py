from rest_framework import serializers
from .models import Bracnch, Employee


class BranchSerializer(serializers.ModelSerializer):
    user = serializers.StringRelatedField(many=True)

    class Meta:
        model = Bracnch
        fields = '__all__'


class EmployeeSerializer(serializers.ModelSerializer):
    branch = serializers.StringRelatedField(read_only=False)

    class Meta:
        model = Employee
        fields = '__all__'
