from django.contrib.auth.models import User, Group, Permission
from rest_framework import serializers
from django.contrib.auth import get_user_model

User = get_user_model()


class UserSerializer(serializers.ModelSerializer):
    class Meta:
        model = User
        fields = '__all__'
        extra_kwargs = {'password': {'write_only': True}}


# class UserSerializer(serializers.ModelSerializer):
#     class Meta:
#         model = User
#         fields = ['username', 'email', 'password', 'is_staff',]
#         extra_kwargs = {'password': {'write_only': True}}

#     def create(self, validated_data):
#         username = validated_data['username']
#         email = validated_data['email']
#         password = validated_data['password']
#         user_obj = User(username=username, email=email, is_staff=True)
#         user_obj.set_password(password)
#         user_obj.save()
#         return validated_data

#     def update(self, instance, validated_data):
#         instance.username = validated_data.get('username', instance.username)
#         instance.email = validated_data.get('email', instance.email)
#         instance.save()

#         return instance


class GroupSerializer(serializers.ModelSerializer):
    class Meta:
        model = Group
        fields = '__all__'


class PermissionSerializer(serializers.ModelSerializer):
    class Meta:
        model = Permission
        fields = '__all__'
