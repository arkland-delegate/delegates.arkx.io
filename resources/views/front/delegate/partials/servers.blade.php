<div class="content white heading">
    <div class="kicker">
        <h4 class="mb-3">Servers</h4>
        <p>Without question, the most important role of a delegate is to maintain the ARK network. Every delegate will run at least one node: the forger that's used to create blocks and collect rewards. Some delegates run multiple forging nodes to ensure that one node's failure won't affect voter payouts. Others run relay nodes to power their applications and facilitate the spread of data across the network. Regardless of type, more nodes equals more network security, so delegates running multiple nodes are highly regarded at ARK.</p>
    </div>
</div>

@foreach($delegate->servers as $server)
    <div class="content white heading">
        <div class="kicker">
            <h4>{{ ucfirst($server->type) }}</h4>
        </div>

        <ul>
            <li>
                <span>Network</span>
                <span>{{ $server->network_name }}</span>
            </li>

            <li>
                <span>Country</span>
                <span>{{ $server->country->name }}</span>
            </li>

            <li>
                <span>CPU</span>
                <span>{{ $server->cpu }}</span>
            </li>

            <li>
                <span>RAM</span>
                <span>{{ $server->ram }}</span>
            </li>

            <li>
                <span>Disk</span>
                <span>{{ $server->disk }}</span>
            </li>

            <li>
                <span>Network Speed</span>
                <span>{{ $server->connection }}</span>
            </li>
        </ul>
    </div>
@endforeach
