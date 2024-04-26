# views.py
from django.shortcuts import render
from django.views import View

class HomeView(View):
    def get(self, request):
        return render(request, 'home.html')  # Render your home page template

# urls.py
from django.urls import path
from .views import SignUpView, HomeView

urlpatterns = [
    path('', HomeView.as_view(), name='home'),  # Define a view for the root URL
    path('signup/', SignUpView.as_view(), name='signup'),
    # Other URL patterns
]
