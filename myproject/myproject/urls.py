# myproject/urls.py
from django.urls import path
from voting.views import SignUpView

urlpatterns = [
    ...
    path('signup/', SignUpView.as_view(), name='signup'),
]
