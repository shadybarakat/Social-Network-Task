         @props(['connection', 'user'])
         <div class="ml-4 friend-action" data-user="{{ $user->id }}">
             @if (!$connection)
                 <x-primary-button class="add-friend-btn" data-url="{{ route('connections.send', $user->id) }}">Add
                     Friend</x-primary-button>
             @elseif($connection->status == 'pending')
                 @if ($connection->receiver_id == auth()->id())
                     <x-primary-button class="accept-friend-btn"
                         data-url="{{ route('connections.accept', $connection) }}">Accept
                         Request</x-primary-button>
                     <x-danger-button class="reject-friend-btn"
                         data-url="{{ route('connections.reject', $connection) }}">Reject
                         Request</x-danger-button>
                 @else
                     <span class="text-gray-500">Pending</span>
                 @endif
             @elseif($connection->status == 'accepted')
                 <span class="text-green-500">Friend</span>
             @elseif($connection->status == 'rejected')
                 <span class="text-red-500">Rejected</span>
             @endif
         </div>
